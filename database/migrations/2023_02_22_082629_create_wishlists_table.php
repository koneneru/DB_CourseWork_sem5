<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user')->references('id')->on('users');
            $table->foreignId('product')->references('id')->on('products');
        });
    }
    public function down()
    {
        Schema::dropIfExists('wishlits');
    }
}
