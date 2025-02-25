<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration {
    public function up() {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services');
            $table->string('comment')->nullable();
            $table->string('url_image')->nullable();
            $table->integer('stars');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('review');
    }
}

