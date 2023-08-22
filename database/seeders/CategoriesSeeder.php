<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Congelados',
            ],
            [
                'name' => 'Fritos',
            ],
        ];

        DB::table('categories')->insert($products);
    }
}
