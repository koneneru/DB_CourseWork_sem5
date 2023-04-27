<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $updated_at = $this->faker->dateTimeBetween('-3 years', 'now', null);
        return [
            'status' => OrderStatus::inRandomOrder()->first(),
            'user' => User::inRandomOrder()->first(),
            'updated_at' => $updated_at,
            'created_at' => $this->faker->dateTimeBetween('-3 years', $updated_at, null),
        ];
    }
}
