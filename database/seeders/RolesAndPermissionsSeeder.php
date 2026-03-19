<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Members
            'members.view',
            'members.view.own',
            'members.create',
            'members.edit',
            'members.delete',
            'members.export',

            // Branches
            'branches.view',
            'branches.create',
            'branches.edit',
            'branches.delete',

            // Zones
            'zones.view',
            'zones.view.own',
            'zones.create',
            'zones.edit',
            'zones.delete',

            // Bacentas
            'bacentas.view',
            'bacentas.view.own',
            'bacentas.create',
            'bacentas.edit',
            'bacentas.delete',

            // Departments
            'departments.view',
            'departments.view.own',
            'departments.create',
            'departments.edit',
            'departments.delete',

            // Attendance & Reports
            'reports.view',
            'reports.view.own',
            'reports.view.zone',
            'reports.create',
            'reports.edit',
            'reports.delete',
            'reports.export',

            // Finances
            'finances.view',
            'finances.view.own',
            'finances.create',
            'finances.edit',
            'finances.delete',
            'finances.export',

            // Dashboard
            'dashboard.view',
            'dashboard.view.global',
            'dashboard.view.zone',
            'dashboard.view.bacenta',

            // Settings & Admin
            'settings.view',
            'settings.edit',
            'users.manage',
            'roles.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Bishop - Full access
        $bishop = Role::firstOrCreate(['name' => 'bishop']);
        $bishop->syncPermissions(Permission::all());

        // Admin - Technical management
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // Reverend
        $reverend = Role::firstOrCreate(['name' => 'reverend']);
        $reverend->syncPermissions([
            'members.view', 'members.create', 'members.edit',
            'branches.view', 'branches.edit',
            'zones.view', 'zones.create', 'zones.edit',
            'bacentas.view', 'bacentas.create', 'bacentas.edit',
            'departments.view', 'departments.create', 'departments.edit',
            'reports.view', 'reports.create', 'reports.edit', 'reports.export',
            'finances.view', 'finances.export',
            'dashboard.view', 'dashboard.view.global',
        ]);

        // Pastor Assistant
        $pastorAssistant = Role::firstOrCreate(['name' => 'pastor_assistant']);
        $pastorAssistant->syncPermissions([
            'members.view', 'members.create', 'members.edit',
            'branches.view',
            'zones.view', 'zones.create', 'zones.edit',
            'bacentas.view', 'bacentas.create', 'bacentas.edit',
            'departments.view',
            'reports.view', 'reports.create', 'reports.edit',
            'finances.view',
            'dashboard.view', 'dashboard.view.global',
        ]);

        // Minister
        $minister = Role::firstOrCreate(['name' => 'minister']);
        $minister->syncPermissions([
            'members.view',
            'zones.view',
            'bacentas.view',
            'departments.view',
            'reports.view',
            'dashboard.view', 'dashboard.view.global',
        ]);

        // Zone Leader
        $zoneLeader = Role::firstOrCreate(['name' => 'zone_leader']);
        $zoneLeader->syncPermissions([
            'members.view',
            'zones.view.own',
            'bacentas.view', 'bacentas.create', 'bacentas.edit',
            'departments.view',
            'reports.view.zone', 'reports.create', 'reports.edit',
            'dashboard.view', 'dashboard.view.zone',
        ]);

        // Shepherd (Berger)
        $shepherd = Role::firstOrCreate(['name' => 'shepherd']);
        $shepherd->syncPermissions([
            'members.view',
            'bacentas.view.own',
            'reports.view.own', 'reports.create',
            'dashboard.view', 'dashboard.view.bacenta',
        ]);

        // Department Leader
        $departmentLeader = Role::firstOrCreate(['name' => 'department_leader']);
        $departmentLeader->syncPermissions([
            'members.view',
            'departments.view.own', 'departments.edit',
            'dashboard.view',
        ]);

        // Treasurer
        $treasurer = Role::firstOrCreate(['name' => 'treasurer']);
        $treasurer->syncPermissions([
            'members.view',
            'finances.view', 'finances.create', 'finances.edit', 'finances.export',
            'reports.view',
            'dashboard.view', 'dashboard.view.global',
        ]);

        // Member - Basic access
        $member = Role::firstOrCreate(['name' => 'member']);
        $member->syncPermissions([
            'members.view.own',
            'finances.view.own',
            'reports.view.own',
        ]);
    }
}
