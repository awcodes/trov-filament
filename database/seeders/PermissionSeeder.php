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

        $permissions = [
            'create' => ['users', 'authors', 'pages', 'posts', 'articles'],
            'read' => ['users', 'authors', 'pages', 'posts', 'articles'],
            'edit' => ['users', 'authors', 'pages', 'posts', 'articles'],
            'delete' => ['users', 'authors', 'pages', 'posts', 'articles'],
            'manage' => ['users', 'authors', 'pages', 'posts', 'articles']
        ];

        foreach ($permissions as $permission => $models) {
            foreach ($models as $model) {
                Permission::create(['name' => $permission . ' ' . $model]);
            }
        }

        $role = Role::create(['name' => 'Titan']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Admin']);
    }
}
