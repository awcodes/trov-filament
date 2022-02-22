<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::all();
        $editor = Role::whereNotIn('name', ['Users Manager', 'ACL Manager'])->get();

        $users = [
            [
                'name' => 'Adam Weston',
                'email' => 'adam.weston@titlemax.com',
                'roles' => $admin
            ],
            [
                'name' => 'Scott Kublin',
                'email' => 'scott.kublin@titlemax.com',
                'roles' => $admin
            ],
            [
                'name' => 'Carly Hallman',
                'email' => 'carly.hallman@titlemax.com',
                'roles' => $admin
            ],
            [
                'name' => 'Oleg Amir',
                'email' => 'oleg.amir@titlemax.com',
                'roles' => $editor
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create([
                'name' => $user['name'],
                'email' => $user['email'],
            ])->assignRole($user['roles']);
        }
    }
}
