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
        Schema::create('spells', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 1000);
            $table->Integer('level');
            $table->string('school', 50);
            $table->string('casting_time', 50);
            $table->string('duration', 50);
            $table->string('range', 50);
            $table->string('components', 100);
            $table->foreignId('manual_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spells');
    }
};