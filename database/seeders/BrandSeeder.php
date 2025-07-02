<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('brands')->insert([
        [
            'brand_name' => 'S24 Ultra',
            'description' => 'this is s24 ultra',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand_name' => 'Nokia',
            'description' => 'this is nokia',
      
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'brand_name' => 'Google',
            'description' => 'this is google',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
