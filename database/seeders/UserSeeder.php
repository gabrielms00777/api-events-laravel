<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'role' => 'admin',
            'email' => 'admin@admin',
            'password' => 'admin',
        ]);
        
        User::factory()->count(2)->create([
            'role' => 'event_owner',
        ]);

        User::factory()->count(5)->create([
            'role' => 'staff',
        ]);

        User::factory()->count(10)->create([
            'role' => 'visitor',
        ]);
    }
}
