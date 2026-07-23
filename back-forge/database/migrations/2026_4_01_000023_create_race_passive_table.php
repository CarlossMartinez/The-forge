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
        Schema::create('race_passive', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('passive_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_passive');
    }
}; 