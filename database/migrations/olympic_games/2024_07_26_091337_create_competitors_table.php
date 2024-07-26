<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->string('original_id');
            $table->string('event_id');
            $table->string('country_id');
            $table->string('name')->nullable();
            $table->integer('position')->nullable();
            $table->string('result_position')->nullable();
            $table->string('result_winnerLoserTie')->nullable();
            $table->string('result_mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitors');
    }
};
