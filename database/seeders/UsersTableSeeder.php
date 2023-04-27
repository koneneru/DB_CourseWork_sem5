<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'role' => Role::where('name', 'admin')->value('id'),
        ]);
        User::factory(5)->create([
            'role' => Role::where('name', 'customer')->value('id'),
        ]);
    }
}
