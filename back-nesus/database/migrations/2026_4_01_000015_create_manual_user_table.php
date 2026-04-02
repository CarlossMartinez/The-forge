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
        Schema::create('manual_user', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_owner')->default(false);
            $table->boolean('enabled')->default(false);
            $table->foreign('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('manual_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manueal_user');
    }
}; 