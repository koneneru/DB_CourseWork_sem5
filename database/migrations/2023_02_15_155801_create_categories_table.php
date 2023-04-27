<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id');
            $table->boolean('available')->default(false);
            $table->string('name');
            $table->string('title');
            $table->string('image')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
