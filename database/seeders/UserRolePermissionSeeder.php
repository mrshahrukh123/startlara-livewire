<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $secure_permission_arr = array(
            'list-permission',
            'create-permission',
            'update-permission',
            'delete-permission',
        );

        $permissions_arr = array(
            'list-role',
            'create-role',
            'update-role',
            'delete-role',
            'list-user',
            'create-user',
            'update-user',
            'delete-user',
            'manage-settings',
        );

        $writer_arr = array(
            'list-post',
            'create-post',
            'update-post',
            'delete-post'
        );

        $dev_admin_permissions = array_merge($permissions_arr, $secure_permission_arr,$writer_arr);

        $admin_permission_arr = array_merge($permissions_arr);

        foreach ($dev_admin_permissions as $permission_name) {
            Permission::create(['name' => $permission_name]);
        }

        $role = Role::create(['name' => User::DEV_ADMIN_ROLE]);
        $role_admin = Role::create(['name' => User::ADMIN_ROLE]);
        $role_writer = Role::create(['name' => User::WRITER_ROLE]);

        foreach ($admin_permission_arr as $permission_name) {
            if ($permission_name) {
                $role_admin->givePermissionTo($permission_name);
            }
        }

        foreach ($writer_arr as $permission_name) {
            if ($permission_name) {
                $role_writer->givePermissionTo($permission_name);
            }
        }

        $user = \App\Models\User::factory()->create([
            'name' => 'Dev Admin',
            'email' => 'devadmin@filament-cms.local',
        ]);
        $user->assignRole($role);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@filament-cms.local',
        ]);
        $user->assignRole($role_admin);

        $user = \App\Models\User::factory()->create([
            'name' => 'Writer',
            'email' => 'writer@filament-cms.local',
        ]);
        $user->assignRole($role_writer);
    }
}
