<?php

namespace Database\Factories;

use App\Models\wishlist;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    public function definition()
    {
        return [
            'user' => User::inRandomOrder()->first(),
            'product' => Product::inRandomOrder()->first(),
        ];
    }
}
