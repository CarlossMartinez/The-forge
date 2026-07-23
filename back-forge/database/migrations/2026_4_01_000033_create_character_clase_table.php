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
        Schema::create('character_clase', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')
                ->constrained('characters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('clase_id')
                ->constrained('clases')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('subclass_id')
                ->nullable()
                ->constrained('subclasses')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->integer('level')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_clase');
    }
};