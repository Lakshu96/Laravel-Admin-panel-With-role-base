<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $guard = 'web';

        $definitions = [
            ['name' => 'admin.dashboard', 'module_name' => 'admin', 'description' => 'Access admin dashboard'],
            ['name' => 'users.view', 'module_name' => 'users', 'description' => 'List users'],
            ['name' => 'users.create', 'module_name' => 'users', 'description' => 'Create users'],
            ['name' => 'users.edit', 'module_name' => 'users', 'description' => 'Edit users'],
            ['name' => 'users.delete', 'module_name' => 'users', 'description' => 'Delete users'],
            ['name' => 'roles.view', 'module_name' => 'roles', 'description' => 'List roles'],
            ['name' => 'roles.create', 'module_name' => 'roles', 'description' => 'Create roles'],
            ['name' => 'roles.edit', 'module_name' => 'roles', 'description' => 'Edit roles'],
            ['name' => 'roles.delete', 'module_name' => 'roles', 'description' => 'Delete roles'],
            ['name' => 'orders.approve', 'module_name' => 'orders', 'description' => 'Approve orders'],
            ['name' => 'trucks.view', 'module_name' => 'trucks', 'description' => 'List trucks'],
            ['name' => 'trucks.create', 'module_name' => 'trucks', 'description' => 'Create trucks'],
            ['name' => 'trucks.edit', 'module_name' => 'trucks', 'description' => 'Edit trucks'],
            ['name' => 'trucks.delete', 'module_name' => 'trucks', 'description' => 'Delete trucks'],
        ];

        foreach ($definitions as $def) {
            Permission::firstOrCreate(
                ['name' => $def['name'], 'guard_name' => $guard],
                [
                    'module_name' => $def['module_name'],
                    'slug' => $def['name'],
                    'description' => $def['description'],
                ]
            );
        }

        /*
        | Replace all roles so lowercase names (admin, user, …) are not merged with
        | legacy PascalCase rows under MySQL's default case-insensitive unique index on `name`.
        */
        Schema::disableForeignKeyConstraints();
        try {
            Role::query()->delete();
        } finally {
            Schema::enableForeignKeyConstraints();
        }

        /*
        | Ben's Appliances–style roles (lowercase, as in legacy Manage UI).
        | Adjust permission lists when you add Trucks, Parts, Kits, etc.
        */
        $roles = [
            'Super Admin' => Permission::pluck('name')->all(),
            'admin' => [
                'admin.dashboard',
                'users.view', 'users.create', 'users.edit', 'users.delete',
                'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
                'orders.approve',
                'trucks.view', 'trucks.create', 'trucks.edit', 'trucks.delete',
            ],
            'technician' => [
                'admin.dashboard',
                'users.view',
                'trucks.view', 'trucks.edit',
            ],
            'kit_assigner' => [
                'admin.dashboard',
                'orders.approve',
                'trucks.view', 'trucks.create', 'trucks.edit',
            ],
            'user' => [],
        ];

        foreach ($roles as $roleName => $permissionNames) {
            $role = Role::create([
                'name' => $roleName,
                'guard_name' => $guard,
                'description' => 'Seeded '.$roleName.' role',
            ]);

            $role->syncPermissions(Arr::wrap($permissionNames));
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
