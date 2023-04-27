<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_statuses')->insert([
            'name' => 'open',
            'title' => 'Открыт',
        ]);

        DB::table('order_statuses')->insert([
            'name' => 'comleted',
            'title' => 'Завершён',
        ]);

        DB::table('order_statuses')->insert([
            'name' => 'rejected',
            'title' => 'Отменён',
        ]);
    }
}
