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
        Schema::create('spell_slots', function (Blueprint $table) {
            $table->integer('spell_level')->primary();
            $table->integer('slots_total');
            $table->integer('slots_used')->default(0)->check('slots_used >= 0');
            $table->boolean('is_equipped')->default(false);
            $table->boolean('is_attuned')->default(false);
            $table->foreignId('character_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spell_slots');
    }
}; 