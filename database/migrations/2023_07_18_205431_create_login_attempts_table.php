<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('ip_address');
            $table->string('session_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('login_attempts');
    }
}

