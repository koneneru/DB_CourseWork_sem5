<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductsInOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsInOrderFactory extends Factory
{
    protected $model = ProductsInOrder::class;

    public function definition()
    {
        return [
            'order' => Order::inRandomOrder()->first(),
            'product' => Product::inRandomOrder()->first(),
            'count' => $this->faker->numberBetween(1, 5),
        ];
    }
}
