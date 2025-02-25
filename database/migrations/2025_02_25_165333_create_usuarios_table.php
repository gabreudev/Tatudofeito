<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['client', 'worker', 'admin']);
            $table->string('specialties')->nullable();
            $table->float('average_rating')->default(0)->nullable();
            $table->string('payment_methods')->nullable();
            $table->float('daily_value')->nullable();
            $table->text('descricription')->nullable();
            $table->boolean('is_baned')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('users');
    }
}
