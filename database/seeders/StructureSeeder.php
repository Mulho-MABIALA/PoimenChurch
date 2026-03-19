<?php

namespace Database\Seeders;

use App\Models\Bacenta;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    public function run(): void
    {
        // Get users for assignments
        $bishop = User::whereHas('roles', fn($q) => $q->where('name', 'bishop'))->first();
        $zoneLeader = User::whereHas('roles', fn($q) => $q->where('name', 'zone_leader'))->first();
        $shepherd = User::whereHas('roles', fn($q) => $q->where('name', 'shepherd'))->first();

        // Create main branch (Dakar)
        $mainBranch = Branch::create([
            'name' => 'Poimen Church Dakar',
            'description' => 'Église principale de Dakar',
            'address' => 'Quartier Plateau, Dakar',
            'city' => 'Dakar',
            'leader_id' => $bishop?->id,
            'is_active' => true,
        ]);

        // Create zones
        $zonePlateau = Zone::create([
            'name' => 'Zone Plateau',
            'description' => 'Zone couvrant le quartier du Plateau',
            'branch_id' => $mainBranch->id,
            'leader_id' => $zoneLeader?->id,
            'is_active' => true,
        ]);

        $zoneMedina = Zone::create([
            'name' => 'Zone Médina',
            'description' => 'Zone couvrant le quartier de la Médina',
            'branch_id' => $mainBranch->id,
            'is_active' => true,
        ]);

        $zoneGrandDakar = Zone::create([
            'name' => 'Zone Grand Dakar',
            'description' => 'Zone couvrant Grand Dakar',
            'branch_id' => $mainBranch->id,
            'is_active' => true,
        ]);

        // Create bacentas for Zone Plateau
        $bacentaEspoir = Bacenta::create([
            'name' => 'Bacenta Espoir',
            'description' => 'Bacenta du quartier Espoir',
            'address' => 'Rue 10, Plateau',
            'zone_id' => $zonePlateau->id,
            'shepherd_id' => $shepherd?->id,
            'meeting_day' => 'wednesday',
            'meeting_time' => '18:30',
            'is_active' => true,
        ]);

        Bacenta::create([
            'name' => 'Bacenta Lumière',
            'description' => 'Bacenta Lumière du Plateau',
            'address' => 'Avenue Léopold Sédar Senghor',
            'zone_id' => $zonePlateau->id,
            'meeting_day' => 'thursday',
            'meeting_time' => '19:00',
            'is_active' => true,
        ]);

        // Create bacentas for Zone Médina
        Bacenta::create([
            'name' => 'Bacenta Grâce',
            'description' => 'Bacenta Grâce de la Médina',
            'address' => 'Rue 15, Médina',
            'zone_id' => $zoneMedina->id,
            'meeting_day' => 'wednesday',
            'meeting_time' => '18:00',
            'is_active' => true,
        ]);

        Bacenta::create([
            'name' => 'Bacenta Foi',
            'description' => 'Bacenta Foi de la Médina',
            'address' => 'Rue 22, Médina',
            'zone_id' => $zoneMedina->id,
            'meeting_day' => 'friday',
            'meeting_time' => '19:00',
            'is_active' => true,
        ]);

        // Create bacentas for Zone Grand Dakar
        Bacenta::create([
            'name' => 'Bacenta Victoire',
            'description' => 'Bacenta Victoire de Grand Dakar',
            'address' => 'Grand Dakar, Rue 5',
            'zone_id' => $zoneGrandDakar->id,
            'meeting_day' => 'wednesday',
            'meeting_time' => '18:30',
            'is_active' => true,
        ]);

        // Create departments
        Department::create([
            'name' => 'Chorale',
            'description' => 'Département de louange et adoration',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Accueil',
            'description' => 'Département d\'accueil des fidèles',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Jeunesse',
            'description' => 'Département des jeunes',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Femmes',
            'description' => 'Département des femmes',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Hommes',
            'description' => 'Département des hommes',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Enfants',
            'description' => 'École du dimanche et activités enfants',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Média',
            'description' => 'Département audiovisuel et communication',
            'is_active' => true,
        ]);

        Department::create([
            'name' => 'Intercession',
            'description' => 'Équipe de prière',
            'is_active' => true,
        ]);

        // Attach members to bacenta
        if ($shepherd) {
            $bacentaEspoir->members()->attach($shepherd->id);
        }

        // Attach members to zone
        if ($zoneLeader) {
            $zonePlateau->members()->attach($zoneLeader->id);
        }
    }
}
