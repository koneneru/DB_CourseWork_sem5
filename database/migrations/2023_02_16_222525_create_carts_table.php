<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('product')->references('id')->on('products');
            $table->unsignedTinyInteger('count');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
