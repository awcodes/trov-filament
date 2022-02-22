<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $models = ['Users', 'Authors', 'Pages', 'Posts', 'Articles', 'Faqs', 'Discovery Center', 'Landing Pages'];

        $permissions = [
            'Create',
            'Read',
            'Edit',
            'Delete',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            foreach ($models as $model) {
                Permission::create(['name' => $permission . ' ' . $model]);
            }
        }

        // Create Roles
        foreach ($models as $model) {
            $role = Role::create(['name' => $model . ' Manager']);
            $role->givePermissionTo([
                'Create ' . $model,
                'Read ' . $model,
                'Edit ' . $model,
                'Delete ' . $model,
            ]);
        }

        Role::create(['name' => 'ACL Manager']);
    }
}
