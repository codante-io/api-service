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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('original_id')->unique();
            $table->date('day');
            $table->string('discipline_id');
            $table->string('discipline_name');
            $table->string('venue_id');
            $table->string('venue_name');
            $table->string('event_name');
            $table->string('event_unit_name');
            $table->string('event_name_portuguese');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->nullable();
            $table->boolean('is_medal_event')->default(false);
            $table->boolean('is_live')->default(false);
            $table->timestamps();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('discipline_id')->references('id')->on('disciplines');
            $table->foreign('venue_id')->references('id')->on('venues');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
