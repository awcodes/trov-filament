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
            'create' => ['users', 'authors', 'pages', 'posts', 'articles', 'resources'],
            'read' => ['users', 'authors', 'pages', 'posts', 'articles', 'resources'],
            'edit' => ['users', 'authors', 'pages', 'posts', 'articles', 'resources'],
            'delete' => ['users', 'authors', 'pages', 'posts', 'articles', 'resources'],
            'manage' => ['users', 'authors', 'pages', 'posts', 'articles', 'resources']
        ];

        foreach ($permissions as $permission => $models) {
            foreach ($models as $model) {
                Permission::create(['name' => $permission . ' ' . $model]);
            }
        }

        $role = Role::create(['name' => 'Titan']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(['manage users', 'manage authors', 'manage pages', 'manage posts', 'manage articles', 'manage resources']);
    }
}
