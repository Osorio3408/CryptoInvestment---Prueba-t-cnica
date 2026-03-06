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
        Schema::table('cryptocurrencies', function (Blueprint $table) {
            $table->decimal('price', 20, 10)->default(0);
            $table->decimal('percent_change_24h', 10, 4)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('cryptocurrencies', function (Blueprint $table) {
            $table->dropColumn(['price', 'percent_change_24h']);
        });
    }
};
