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
                'price' => 1200,
                'image' => 'palitos.png',
                'discount' => 0,
                'category_id' => 2,
            ],
            [
                'name' => 'Mini Tequeños',
                'description' => 'Una delicia en tamaño miniatura, no podras parar de comerlos',
                'price' => 700,
                'image' => 'mini_teque.jpg',
                'discount' => 0,
                'category_id' => 2,
            ],
            [
                'name' => 'Teque Box x 100',
                'description' => '100 deliciosos tequeños para cualquier tipo de evento. No querras que se acaben',
                'price' => 100000,
                'image' => 'teque_box.jpg',
                'discount' => 0,
                'category_id' => 2,
            ],
            [
                'name' => 'Tequeyoyos',
                'description' => 'Delicioso y unico relleno de maduro jamón y abundante queso',
                'price' => 3000,
                'image' => 'Tequeyoyos.jpg',
                'discount' => 0,
                'category_id' => 2,
            ],
            [
                'name' => 'Tequeños Congelados',
                'description' => 'Exquisitos palitos rellenos de mucho queso',
                'price' => 950,
                'image' => 'teque_mantel.png',
                'discount' => 5,
                'category_id' => 1,
            ],
            [
                'name' => 'Tequeyoyos Congelados',
                'description' => 'Delicioso y unico relleno de maduro jamón y abundante queso',
                'price' => 2500,
                'image' => 'yoyo_mantel.png',
                'discount' => 8,
                'category_id' => 1,
            ],
            [
                'name' => 'Pastelito de choriqueso',
                'description' => 'Deliciosa mezcla de sabores y texturas en un solo bocado',
                'price' => 1600,
                'image' => null,
                'discount' => 0,
                'category_id' => 2,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
