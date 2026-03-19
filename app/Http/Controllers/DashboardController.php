<?php

namespace App\Http\Controllers;

use App\Models\Bacenta;
use App\Models\BacentaReport;
use App\Models\Branch;
use App\Models\FinancialTransaction;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistiques globales
        $stats = $this->getStats($user);

        // Données pour les graphiques
        $charts = $this->getChartData($user);

        // Rapports récents
        $recentReports = $this->getRecentReports($user);

        // Top Bacentas
        $topBacentas = $this->getTopBacentas($user);

        return view('dashboard.index', compact('stats', 'charts', 'recentReports', 'topBacentas'));
    }

    protected function getStats($user)
    {
        if ($user->hasRole(['bishop', 'admin', 'reverend'])) {
            return $this->getAdminStats();
        }

        if ($user->hasRole('zone_leader')) {
            return $this->getZoneLeaderStats($user);
        }

        return $user->hasRole('shepherd')
            ? $this->getShepherdStats($user)
            : $this->getMemberStats($user);
    }

    private function getAdminStats(): array
    {
        // Comptes structuraux : changent rarement → cache 10 min
        $counts = Cache::remember('dashboard.admin.counts', 600, function () {
            return [
                'total_members'  => User::where('is_active', true)->count(),
                'total_bacentas' => Bacenta::where('is_active', true)->count(),
                'total_zones'    => Zone::where('is_active', true)->count(),
                'total_branches' => Branch::where('is_active', true)->count(),
            ];
        });

        // Stats hebdomadaires : une seule requête agrégée au lieu de 3 séparées
        $startOfWeek = now()->startOfWeek();
        $endOfWeek   = now()->endOfWeek();

        $weeklyKey = 'dashboard.admin.weekly.' . $startOfWeek->format('YW');
        $weekly = Cache::remember($weeklyKey, 300, function () use ($startOfWeek, $endOfWeek) {
            $reports = BacentaReport::selectRaw(
                    'SUM(attendance_count) as total_attendance,
                     SUM(offering_amount) as total_offerings,
                     SUM(CASE WHEN report_type = ? THEN attendance_count ELSE 0 END) as sunday_attendance',
                    ['sunday_service']
                )
                ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
                ->first();

            return [
                'weekly_attendance' => (int)   ($reports->sunday_attendance ?? 0),
                'weekly_offerings'  => (float) ($reports->total_offerings ?? 0),
            ];
        });

        $monthlyTithes = Cache::remember('dashboard.admin.tithes.' . now()->format('Ym'), 600, function () {
            return FinancialTransaction::whereMonth('transaction_date', now()->month)
                ->whereYear('transaction_date', now()->year)
                ->where('transaction_type', 'tithe')
                ->sum('amount');
        });

        return array_merge($counts, $weekly, [
            'monthly_tithes'  => $monthlyTithes,
            'pending_reports' => $this->getPendingReportsCount(),
        ]);
    }

    private function getZoneLeaderStats($user): array
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $zoneIds = $user->ledZones->pluck('id');

        return [
            'total_members' => User::whereHas('zones', fn($q) => $q->whereIn('zones.id', $zoneIds))->count(),
            'total_bacentas' => Bacenta::whereIn('zone_id', $zoneIds)->where('is_active', true)->count(),
            'weekly_attendance' => BacentaReport::whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds))
                ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
                ->where('report_type', 'sunday_service')
                ->sum('attendance_count'),
            'weekly_offerings' => BacentaReport::whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds))
                ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
                ->sum('offering_amount'),
        ];
    }

    private function getShepherdStats($user): array
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $bacentaIds = $user->shepherdedBacentas->pluck('id');

        return [
            'total_members' => User::whereHas('bacentas', fn($q) => $q->whereIn('bacentas.id', $bacentaIds))->count(),
            'weekly_attendance' => BacentaReport::whereIn('bacenta_id', $bacentaIds)
                ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
                ->where('report_type', 'sunday_service')
                ->sum('attendance_count'),
            'weekly_offerings' => BacentaReport::whereIn('bacenta_id', $bacentaIds)
                ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
                ->sum('offering_amount'),
        ];
    }

    private function getMemberStats($user): array
    {
        return [
            'attendance_rate' => $user->getAttendanceRate('sunday_service', 3),
            'total_donations' => $user->getTotalDonations(now()->year),
        ];
    }

    protected function getChartData($user)
    {
        $weeks = 8;
        $rangeStart = now()->subWeeks($weeks - 1)->startOfWeek();
        $rangeEnd   = now()->endOfWeek();

        // Une seule requête GROUP BY au lieu de 16 requêtes en boucle
        $query = BacentaReport::selectRaw(
                'YEARWEEK(report_date, 1) as yw,
                 MIN(report_date) as week_start,
                 SUM(CASE WHEN report_type = ? THEN attendance_count ELSE 0 END) as attendance,
                 SUM(offering_amount) as offerings',
                ['sunday_service']
            )
            ->whereBetween('report_date', [$rangeStart, $rangeEnd])
            ->groupByRaw('YEARWEEK(report_date, 1)')
            ->orderByRaw('YEARWEEK(report_date, 1)');

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
        } elseif ($user->hasRole('shepherd')) {
            $bacentaIds = $user->shepherdedBacentas->pluck('id');
            $query->whereIn('bacenta_id', $bacentaIds);
        }

        $rows = $query->get()->keyBy('yw');

        $attendanceData = [];
        $offeringsData  = [];

        for ($i = $weeks - 1; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $yw = $weekStart->format('oW'); // ISO year-week key

            $attendanceData[] = [
                'week'  => $weekStart->format('d/m'),
                'value' => isset($rows[$yw]) ? (int) $rows[$yw]->attendance : 0,
            ];
            $offeringsData[] = [
                'week'  => $weekStart->format('d/m'),
                'value' => isset($rows[$yw]) ? (float) $rows[$yw]->offerings : 0,
            ];
        }

        return [
            'attendance' => $attendanceData,
            'offerings'  => $offeringsData,
        ];
    }

    protected function getRecentReports($user)
    {
        $query = BacentaReport::with(['bacenta.zone', 'submittedBy'])
            ->latest('report_date')
            ->limit(10);

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
        } elseif ($user->hasRole('shepherd')) {
            $bacentaIds = $user->shepherdedBacentas->pluck('id');
            $query->whereIn('bacenta_id', $bacentaIds);
        }

        return $query->get();
    }

    protected function getTopBacentas($user)
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $query = Bacenta::withSum(['reports as total_attendance' => function ($q) use ($startOfMonth, $endOfMonth) {
            $q->whereBetween('report_date', [$startOfMonth, $endOfMonth])
              ->where('report_type', 'sunday_service');
        }], 'attendance_count')
            ->where('is_active', true)
            ->orderByDesc('total_attendance')
            ->limit(5);

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereIn('zone_id', $zoneIds);
        }

        return $query->get();
    }

    protected function getPendingReportsCount()
    {
        $lastSunday = now()->previous('sunday');
        $bacentasWithoutSundayReport = Bacenta::where('is_active', true)
            ->whereDoesntHave('reports', function ($q) use ($lastSunday) {
                $q->where('report_date', $lastSunday)
                  ->where('report_type', 'sunday_service');
            })
            ->count();

        return $bacentasWithoutSundayReport;
    }
}
