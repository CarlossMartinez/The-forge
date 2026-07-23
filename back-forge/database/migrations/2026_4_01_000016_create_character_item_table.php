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
        Schema::create('character_item', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(1)->check('quantity > 0');
            $table->boolean('is_equipped')->default(false);
            $table->boolean('is_attuned')->default(false);
            $table->foreignId('character_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('item_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_item');
    }
}; 