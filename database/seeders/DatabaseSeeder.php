<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('admin123'),
        ]);
        User::factory()->create([
            'name' => 'ivaa',
            'email' => 'meyclariva@gmail.com',
            'password' => Hash::make('iva12345'),
        ]);

        $this->call([
            SeedProject::class, 
        ]);
    }
}
