<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);

        if (!app()->environment('production')) {
            \App\Models\User::factory()->create([
                'name' => 'Adam Weston',
                'email' => 'adam.weston@titlemax.com'
            ])->assignRole('Titan');

            \App\Models\User::factory()->create([
                'name' => 'Scott Kublin',
                'email' => 'scott.kublin@titlemax.com'
            ])->assignRole('Admin')->givePermissionTo([
                'manage users', 'manage authors', 'manage pages', 'manage posts', 'manage articles', 'manage resources'
            ]);

            $d = '/public/images';
            Storage::deleteDirectory($d);
            Storage::makeDirectory($d);

            $this->call(AuthorSeeder::class);
            $this->call(PageSeeder::class);
        }
    }
}
