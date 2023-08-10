<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Tequeños',
                'description' => 'Exquisitos palitos rellenos de mucho queso',
                'price' => 950,
                'image' => 'palitos.png',
                'discount' => 5,
            ],
            [
                'name' => 'Tequeyoyos',
                'description' => 'Delicioso y unico relleno de maduro jamón y abundante queso',
                'price' => 2450,
                'image' => 'Tequeyoyos.jpg',
                'discount' => 8,
            ],
            [
                'name' => 'Pastelito de choriqueso',
                'description' => 'Deliciosa mezcla de sabores y texturas en un solo bocado',
                'price' => 1600,
                'image' => null,
                'discount' => 0,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
