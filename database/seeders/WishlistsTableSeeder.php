<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{
    public function run()
    {
        Wishlist::factory(25)->create();
    }
}
