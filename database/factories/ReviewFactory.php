<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'author' => User::inRandomOrder()->first(),
            'product' => $product = Product::inRandomOrder()->first(),
            'rating' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->paragraphs(3, true),
            'created_at' => $created_at = $this->faker->dateTimeBetween($product->created_at, time(), null),
            'updated_at' => $created_at,
        ];
    }
}
