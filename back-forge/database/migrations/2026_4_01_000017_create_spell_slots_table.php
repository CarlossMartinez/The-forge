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
            $table->integer('spell_level');
            $table->integer('slots_used')->default(0)->check('slots_used >= 0');
            $table->foreignId('character_id')->constrained()->onUpdate('restrict')->onDelete('restrict');

            $table->primary(['spell_level', 'character_id']);
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