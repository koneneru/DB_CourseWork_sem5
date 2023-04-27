<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user' => User::inRandomOrder()->first(),
            'product' => Product::inRandomOrder()->first(),
            'count' => $this->faker->numberBetween(1, 3),
        ];
    }
}
