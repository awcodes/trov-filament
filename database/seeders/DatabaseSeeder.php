<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!app()->environment('production')) {
            \App\Models\User::factory()->create([
                'name' => 'Adam Weston',
                'email' => 'adam.weston@titlemax.com'
            ]);
        }
        // \App\Models\User::factory(10)->create();
    }
}
