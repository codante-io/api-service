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
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('gold_medals')->default(0);
            $table->integer('silver_medals')->default(0);
            $table->integer('bronze_medals')->default(0);
            $table->integer('total_medals')->default(0);
            $table->integer('rank')->default(0);
            $table->integer('rank_total_medals')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('gold_medals');
            $table->dropColumn('silver_medals');
            $table->dropColumn('bronze_medals');
            $table->dropColumn('total_medals');
            $table->dropColumn('rank');
            $table->dropColumn('rank_total_medals');
        });
    }
};
