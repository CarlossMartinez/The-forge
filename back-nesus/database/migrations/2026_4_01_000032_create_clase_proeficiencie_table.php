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
        Schema::create('clase_proeficiencie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clase_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('proeficiencie_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_proeficiencie');
    }
}; 