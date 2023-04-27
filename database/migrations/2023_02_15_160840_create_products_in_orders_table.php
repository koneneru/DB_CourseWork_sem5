<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsInOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('products_in_orders', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order')->references('id')->on('orders');
            $table->foreignId('product')->references('id')->on('products');
            $table->unsignedTinyInteger('count')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_in_orders');
    }
}
