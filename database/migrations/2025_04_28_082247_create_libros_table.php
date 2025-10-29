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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->unique();
            $table->string('autor');
            $table->text('resumen');
            $table->date('fecha_publicacion');
            $table->decimal('precio', 5, 2);
            $table->string('portada');
            $table->integer('edad_minima');
            $table->boolean('leido')->default(false);
            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
