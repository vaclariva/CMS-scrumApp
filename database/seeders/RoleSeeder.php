<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $superAdmin = Role::create([
        //     'name' => 'Super Admin',
        // ]);
        // $admin = Role::create([
        //     'name' => 'Admin',
        // ]);
        $productOwner = Role::create([
            'name' => 'Product Owner',
        ]);
    }
}
