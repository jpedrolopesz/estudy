<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('url');
            $table->integer('price');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('stripe_id')->unique();
            $table->boolean('active')->default(false);
            $table->boolean('recommended')->default(false);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->unique(['user_id', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
