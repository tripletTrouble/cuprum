<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('merdeka17')
        ]);

        $app = \App\Models\Application::create([
            'name' => 'Portal'
        ]);

        $role = $app->roles()->create([
            'name' => 'Administrator'
        ]);

        $app->roles()->create([
            'name' => 'Staff'
        ]);

        $user->roles()->attach($role->id);
    }
}
