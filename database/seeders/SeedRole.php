<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_role')->insert([
            ['role_name' => 'Product Owner'],
            ['role_name' => 'Bussines Alnalist'],
            ['role_name' => 'Programer'],
        ]);
    }
}
