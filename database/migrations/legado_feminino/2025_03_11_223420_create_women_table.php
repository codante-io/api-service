<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('women', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ano_nascimento')->nullable();
            $table->string('ano_morte')->nullable();
            $table->text('contribuicao');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('women');
    }

};
