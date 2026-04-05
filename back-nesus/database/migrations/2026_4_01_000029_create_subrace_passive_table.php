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
        Schema::create('subrace_passive', function (Blueprint $table) {
            $table->id();
            $table->integer('level_required')->default(1);
            $table->foreignId('subrace_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('passive_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subrace_passive');
    }
}; 