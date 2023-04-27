<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        Cart::factory(5)->create();
    }
}
