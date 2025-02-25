<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration {
    public function up() {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('worker_id')->constrained('users');
            $table->text('description');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('services');
    }
}
