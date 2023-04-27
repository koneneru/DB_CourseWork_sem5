<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'available' => true,
            'name' => 'laptops',
            'title' => 'Ноутбуки',
            'image' => 'assets/images/categories/laptops.png',
        ]);

        DB::table('categories')->insert([
            'available' => true,
            'name' => 'headphones',
            'title' => 'Наушники',
            'image' => 'assets/images/categories/headphones.png',
        ]);

        DB::table('categories')->insert([
            'available' => true,
            'name' => 'cameras',
            'title' => 'Камеры',
            'image' => 'assets/images/categories/cameras.png',
        ]);

        DB::table('categories')->insert([
            'available' => true,
            'name' => 'smartphones',
            'title' => 'Смартфоны',
            'image' => 'assets/images/categories/smartphones.png',
        ]);

        DB::table('categories')->insert([
            'available' => true,
            'name' => 'tablets',
            'title' => 'Планшеты',
            'image' => 'assets/images/categories/tablets.png',
        ]);

        DB::table('categories')->insert([
            'available' => false,
            'name' => 'not-implemented-category',
            'title' => 'Not implemented category',
            'image' => 'assets/images/no-image_600x400.png',
        ]);
    }
}
