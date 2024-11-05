<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 2,
            'password' => Hash::make('admin123'),
        ]);
        User::factory()->create([
            'name' => 'uni',
            'email' => 'uni@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('uni12345'),
        ]);
        User::factory()->create([
            'name' => 'Taufik',
            'email' => 'taufik@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'role_id' => 2,
            'password' => Hash::make('password'),
        ]);
    }
}
