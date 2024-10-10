<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory(3)->create();

        Product::factory()->create([
            'icon' => 'ki-duotone ki-abstract-24',
            'name' => 'Projek 1',
            'label' => 'Internal',
            'start_date' => '2024-05-27',
            'end_date' => '2024-05-27',
            'user_id' => 1
        ]);
    }
}
