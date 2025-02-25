<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacoesTable extends Migration {
    public function up() {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('worker_id')->constrained('users');
            $table->string('status');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('requests');
    }
}