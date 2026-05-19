<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 150);
            $table->string('autor', 120);
            $table->string('editorial', 120);
            $table->string('edicion', 80);
            $table->date('fecha_lanzamiento');
            $table->string('imagen_portada');

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};