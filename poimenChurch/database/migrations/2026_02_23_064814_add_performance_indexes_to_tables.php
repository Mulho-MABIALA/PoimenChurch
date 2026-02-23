<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * CREATE INDEX IF NOT EXISTS évite les erreurs de doublon
     * quelle que soit la structure existante de la base.
     */
    public function up(): void
    {
        // bacenta_reports
        DB::statement('CREATE INDEX IF NOT EXISTS idx_br_report_date ON bacenta_reports(report_date)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_br_report_type ON bacenta_reports(report_type)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_bacenta_reports_lookup ON bacenta_reports(bacenta_id, report_date, report_type)');

        // financial_transactions
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_transaction_date ON financial_transactions(transaction_date)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_fiscal_year ON financial_transactions(fiscal_year)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_category ON financial_transactions(category)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_transaction_type ON financial_transactions(transaction_type)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_aggregation ON financial_transactions(fiscal_year, category, transaction_type)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_branch_year ON financial_transactions(branch_id, fiscal_year)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_ft_zone_year ON financial_transactions(zone_id, fiscal_year)');

        // users
        DB::statement('CREATE INDEX IF NOT EXISTS idx_users_is_active ON users(is_active)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_users_deleted_at ON users(deleted_at)');

        // bacentas
        DB::statement('CREATE INDEX IF NOT EXISTS idx_bacentas_zone_active ON bacentas(zone_id, is_active)');

        // zones
        DB::statement('CREATE INDEX IF NOT EXISTS idx_zones_branch_active ON zones(branch_id, is_active)');

        // events
        DB::statement('CREATE INDEX IF NOT EXISTS idx_events_published_date ON events(is_published, start_date)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_events_featured ON events(is_published, is_featured)');

        // schedules
        DB::statement('CREATE INDEX IF NOT EXISTS idx_schedules_active_featured ON schedules(is_active, is_featured, `order`)');

        // testimonials
        DB::statement('CREATE INDEX IF NOT EXISTS idx_testimonials_active_featured ON testimonials(is_active, is_featured, display_order)');

        // leadership_members
        DB::statement('CREATE INDEX IF NOT EXISTS idx_leadership_active_order ON leadership_members(is_active, display_order)');
    }

    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS idx_br_report_date ON bacenta_reports');
        DB::statement('DROP INDEX IF EXISTS idx_br_report_type ON bacenta_reports');
        DB::statement('DROP INDEX IF EXISTS idx_bacenta_reports_lookup ON bacenta_reports');

        DB::statement('DROP INDEX IF EXISTS idx_ft_transaction_date ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_fiscal_year ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_category ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_transaction_type ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_aggregation ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_branch_year ON financial_transactions');
        DB::statement('DROP INDEX IF EXISTS idx_ft_zone_year ON financial_transactions');

        DB::statement('DROP INDEX IF EXISTS idx_users_is_active ON users');
        DB::statement('DROP INDEX IF EXISTS idx_users_deleted_at ON users');

        DB::statement('DROP INDEX IF EXISTS idx_bacentas_zone_active ON bacentas');
        DB::statement('DROP INDEX IF EXISTS idx_zones_branch_active ON zones');

        DB::statement('DROP INDEX IF EXISTS idx_events_published_date ON events');
        DB::statement('DROP INDEX IF EXISTS idx_events_featured ON events');

        DB::statement('DROP INDEX IF EXISTS idx_schedules_active_featured ON schedules');
        DB::statement('DROP INDEX IF EXISTS idx_testimonials_active_featured ON testimonials');
        DB::statement('DROP INDEX IF EXISTS idx_leadership_active_order ON leadership_members');
    }
};
