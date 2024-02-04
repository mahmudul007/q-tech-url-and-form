<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin = Role::create(['name' => 'admin']);

        $user = Role::create(['name' => 'user']);
        // Create Permissions

        $permissions = [

            ['id' => 1, 'name' => 'form_create'],
            ['id' => 2, 'name' => 'form_edit'],
            ['id' => 3, 'name' => 'form_delete'],
            ['id' => 4, 'name' => 'form_view'],
            ['id' => 5, 'name' => 'form_submit'],
            ['id' => 6, 'name' => 'category_access'],
            ['id' => 7, 'name' => 'category_create'],
            ['id' => 8, 'name' => 'category_edit'],
            ['id' => 9, 'name' => 'category_delete'],
            ['id' => 10, 'name' => 'category_view'],
            ['id' => 11, 'name' => 'submission_access'],
            ['id' => 12, 'name' => 'submission_create'],
            ['id' => 13, 'name' => 'submission_edit'],
            ['id' => 14, 'name' => 'submission_delete'],
            ['id' => 15, 'name' => 'submission_view'],
            ['id' => 16, 'name' => 'special_access'],
            ['id' => 17, 'name' => 'url_access'],

        ];
        // Assign Permissions to Role
        foreach ($permissions as $item) {
            Permission::create($item);
        }
        $userPermission = [4, 5, 10, 15,17];
        $admin->syncPermissions(Permission::all());
        $user->syncPermissions(Permission::whereIn('id', $userPermission)->get());

        $this->enableForeignKeys();

    }
}
