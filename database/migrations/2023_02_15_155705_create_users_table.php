<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('role')->references('id')->on('roles')->default(1);
            $table->string('phone', 10)->unique();
            $table->string('nickname', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('firstname', 55)->nullable();
            $table->string('lastname', 55)->nullable();
            $table->string('patronymic', 55)->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
