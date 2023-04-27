<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            OrderStatusesTableSeeder::class,
            OrdersTableSeeder::class,
            ProductsInOrdersTableSeeder::class,
            ReviewsTableSeeder::class,
            CartsTableSeeder::class,
            WishlistsTableSeeder::class,
        ]);
    }
}
