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
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained('empleados')->cascadeOnUpdate()->cascadeOnDelete(); // Encargado de la sucursal
            $table->string('photo_path')->nullable();
            $table->string('name');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('es_matriz')->default(false);
            $table->string('estado')->default('activo'); // 'activo', 'inactivo', 'suspendido'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursals');
    }
};
