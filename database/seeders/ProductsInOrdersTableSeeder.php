<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\ProductsInOrder;
use Illuminate\Database\Seeder;

class ProductsInOrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        foreach($orders as $order)
        {
            ProductsInOrder::factory(random_int(1, 5))->create([
                'order' => $order,
            ]);
        }
    }
}
