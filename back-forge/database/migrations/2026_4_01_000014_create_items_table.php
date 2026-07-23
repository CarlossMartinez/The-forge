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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 1000);
            $table->string('type', 50);
            $table->string('rarity', 50);
            $table->float('weight')->nullable();
            $table->float('value')->nullable();
            $table->string('manual_code');
            $table->foreign('manual_code')
                ->references('manual_code')
                ->on('manuals')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}; 