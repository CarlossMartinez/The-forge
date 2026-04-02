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
        Schema::create('clase_passive', function (Blueprint $table) {
            $table->id();
            $table->integer('level_required')->default(1)->check('level_required > 0');
            $table->foreignId('clase_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('passive_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_passive');
    }
}; 