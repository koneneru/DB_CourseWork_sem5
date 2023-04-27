<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'customer',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
    }
}
