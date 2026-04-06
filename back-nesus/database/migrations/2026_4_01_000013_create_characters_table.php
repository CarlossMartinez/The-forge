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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 1000);
            $table->integer('level')->default(1)->check('level >= 0 AND level <= 20');
            $table->integer('experience')->default(0);
            $table->integer('hp_max');
            $table->integer('hp_current');
            $table->integer('hp_temp')->default(0);
            $table->string('alignment', 20);
            $table->string('image', 255)->nullable();
            $table->foreignId('user_id')->constrained('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('race_id')->nullable()->constrained('races')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('subrace_id')->nullable()->constrained('subraces')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('background_id')->nullable()->constrained('backgrounds')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('clase_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('subclass_id')->nullable()->constrained('subclasses')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::dropIfExists('characters');
    }
};