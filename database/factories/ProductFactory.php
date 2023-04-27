<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $updated_at = $this->faker->dateTimeBetween('-3 years', 'now', null);
        return [
            'category' => Category::where('available', true)->inRandomOrder()->first(),
            'available' => true,
            'name' => $name = $this->faker->words(2, true),
            'title' => $name,
            'price' => $this->faker->numberBetween(999, 100000),
            'remain' => $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->paragraphs(3, true),
            'image' => 'assets/images/no-image_600x600.png',
        ];
    }
}
