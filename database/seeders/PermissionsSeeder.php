<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list announcements']);
        Permission::create(['name' => 'view announcements']);
        Permission::create(['name' => 'create announcements']);
        Permission::create(['name' => 'update announcements']);
        Permission::create(['name' => 'delete announcements']);

        Permission::create(['name' => 'list checks']);
        Permission::create(['name' => 'view checks']);
        Permission::create(['name' => 'create checks']);
        Permission::create(['name' => 'update checks']);
        Permission::create(['name' => 'delete checks']);

        Permission::create(['name' => 'list counters']);
        Permission::create(['name' => 'view counters']);
        Permission::create(['name' => 'create counters']);
        Permission::create(['name' => 'update counters']);
        Permission::create(['name' => 'delete counters']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list feedbacks']);
        Permission::create(['name' => 'view feedbacks']);
        Permission::create(['name' => 'create feedbacks']);
        Permission::create(['name' => 'update feedbacks']);
        Permission::create(['name' => 'delete feedbacks']);

        Permission::create(['name' => 'list manualpayments']);
        Permission::create(['name' => 'view manualpayments']);
        Permission::create(['name' => 'create manualpayments']);
        Permission::create(['name' => 'update manualpayments']);
        Permission::create(['name' => 'delete manualpayments']);

        Permission::create(['name' => 'list onlinepayments']);
        Permission::create(['name' => 'view onlinepayments']);
        Permission::create(['name' => 'create onlinepayments']);
        Permission::create(['name' => 'update onlinepayments']);
        Permission::create(['name' => 'delete onlinepayments']);

        Permission::create(['name' => 'list organizers']);
        Permission::create(['name' => 'view organizers']);
        Permission::create(['name' => 'create organizers']);
        Permission::create(['name' => 'update organizers']);
        Permission::create(['name' => 'delete organizers']);

        Permission::create(['name' => 'list participants']);
        Permission::create(['name' => 'view participants']);
        Permission::create(['name' => 'create participants']);
        Permission::create(['name' => 'update participants']);
        Permission::create(['name' => 'delete participants']);

        Permission::create(['name' => 'list programs']);
        Permission::create(['name' => 'view programs']);
        Permission::create(['name' => 'create programs']);
        Permission::create(['name' => 'update programs']);
        Permission::create(['name' => 'delete programs']);

        Permission::create(['name' => 'list references']);
        Permission::create(['name' => 'view references']);
        Permission::create(['name' => 'create references']);
        Permission::create(['name' => 'update references']);
        Permission::create(['name' => 'delete references']);

        Permission::create(['name' => 'list allstaff']);
        Permission::create(['name' => 'view allstaff']);
        Permission::create(['name' => 'create allstaff']);
        Permission::create(['name' => 'update allstaff']);
        Permission::create(['name' => 'delete allstaff']);

        Permission::create(['name' => 'list stations']);
        Permission::create(['name' => 'view stations']);
        Permission::create(['name' => 'create stations']);
        Permission::create(['name' => 'update stations']);
        Permission::create(['name' => 'delete stations']);

        Permission::create(['name' => 'list transactions']);
        Permission::create(['name' => 'view transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'update transactions']);
        Permission::create(['name' => 'delete transactions']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
