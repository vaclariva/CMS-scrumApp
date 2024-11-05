<?php

namespace Database\Seeders;

use App\Models\Sprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sprint::create([
            'name' => "Sprint 1",
            'description' => "lorem",
            'start_date' => now(),
            'end_date' => now(),
            'status' => 'active',
            'result_review' => "",
            'result_retrospective' => "",
            'product_id' => 1,
        ]);
    }
}
