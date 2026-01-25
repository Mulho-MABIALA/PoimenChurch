<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Bishop/Super Admin
        $bishop = User::firstOrCreate(
            ['email' => 'admin@poimenchurch.org'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Poimen',
                'phone' => '+221 77 000 0000',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'member_since' => now(),
                'is_active' => true,
                'locale' => 'fr',
            ]
        );

        $bishop->syncRoles(['bishop', 'admin']);

        // Create a test Zone Leader
        $zoneLeader = User::firstOrCreate(
            ['email' => 'jean.diop@poimenchurch.org'],
            [
                'first_name' => 'Jean',
                'last_name' => 'Diop',
                'phone' => '+221 77 111 1111',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'member_since' => now()->subYears(2),
                'is_active' => true,
                'locale' => 'fr',
            ]
        );

        $zoneLeader->syncRoles(['zone_leader']);

        // Create a test Shepherd
        $shepherd = User::firstOrCreate(
            ['email' => 'marie.ndiaye@poimenchurch.org'],
            [
                'first_name' => 'Marie',
                'last_name' => 'Ndiaye',
                'phone' => '+221 77 222 2222',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'member_since' => now()->subYear(),
                'is_active' => true,
                'locale' => 'fr',
            ]
        );

        $shepherd->syncRoles(['shepherd']);

        // Create a test Member
        $member = User::firstOrCreate(
            ['email' => 'amadou.fall@poimenchurch.org'],
            [
                'first_name' => 'Amadou',
                'last_name' => 'Fall',
                'phone' => '+221 77 333 3333',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'member_since' => now()->subMonths(6),
                'is_active' => true,
                'locale' => 'fr',
            ]
        );

        $member->syncRoles(['member']);

        // Create a Treasurer
        $treasurer = User::firstOrCreate(
            ['email' => 'fatou.sarr@poimenchurch.org'],
            [
                'first_name' => 'Fatou',
                'last_name' => 'Sarr',
                'phone' => '+221 77 444 4444',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'member_since' => now()->subYears(3),
                'is_active' => true,
                'locale' => 'fr',
            ]
        );

        $treasurer->syncRoles(['treasurer']);
    }
}
