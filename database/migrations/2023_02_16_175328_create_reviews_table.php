<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('product')->references('id')->on('products');
            $table->foreignId('author')->references('id')->on('users');
            $table->unsignedTinyInteger('rating');
            $table->string('review', 4096);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
