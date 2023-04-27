<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('category')->references('id')->on('categories');
            $table->boolean('available')->default(false);
            $table->string('name')->unique();
            $table->string('title');
            $table->unsignedInteger('price')->unsigned()->default(0);
            $table->unsignedSmallInteger('remain')->unsigned()->default(0);
            $table->string('description', 8192)->nullable();
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
