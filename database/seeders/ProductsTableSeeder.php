<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $this->createLaptops(4);
        $this->createHeadphones(2);
        $this->createCameras();
        $this->createSmartphones();
        $this->createTablets();

        Product::factory(3)->create([
            'remain' => 0,
        ]);

        Product::factory()->create([
            'available' => false,
            'title' => "Этот товар не доступен",
        ]);

        Product::factory(5)->create();
    }

    private function createLaptops($amount = 1)
    {
        for($i = 1; $i <= $amount; $i++)
        {
            Product::factory()->create([
                'category' => Category::where('name', 'laptops')->value('id'),
                'image' => "assets/images/products/laptops/laptop0$i.png",
            ]);
        }
    }

    private function createCameras($amount = 1)
    {
        for($i = 1; $i <= $amount; $i++)
        {
            Product::factory()->create([
                'category' => Category::where('name', 'cameras')->value('id'),
                'image' => "assets/images/products/cameras/camera0$i.png",
            ]);
        }
    }

    private function createHeadphones($amount = 1)
    {
        for($i = 1; $i <= $amount; $i++)
        {
            Product::factory()->create([
                'category' => Category::where('name', 'headphones')->value('id'),
                'image' => "assets/images/products/headphones/headphones0$i.png",
            ]);
        }
    }

    private function createSmartphones($amount = 1)
    {
        for($i = 1; $i <= $amount; $i++)
        {
            Product::factory()->create([
                'category' => Category::where('name', 'smartphones')->value('id'),
                'image' => "assets/images/products/smartphones/smartphone0$i.png",
            ]);
        }
    }

    private function createTablets($amount = 1)
    {
        for($i = 1; $i <= $amount; $i++)
        {
            Product::factory()->create([
                'category' => Category::where('name', 'tablets')->value('id'),
                'image' => "assets/images/products/tablets/tablet0$i.png",
            ]);
        }
    }
}