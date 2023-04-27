<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'phone' => $this->faker->unique()->numerify('#########'),
            'nickname' => $this->faker->userName,
            'email' => $this->faker->email,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'patronymic' => $this->faker->firstName,
            'address' => $this->faker->address,
            'image' => 'assets/images/no-image_100x100.png',
            'password' => $this->faker->password,
        ];
    }
}
