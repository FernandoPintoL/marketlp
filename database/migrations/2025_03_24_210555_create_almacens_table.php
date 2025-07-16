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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->string('sigla')->unique();
            $table->string('name')->nullable();
            $table->string('direccion')->nullable();
            $table->timestamps();
            $table->foreignId('empleado_id')->nullable()->constrained('empleados')->cascadeOnDelete()->cascadeOnUpdate(); // responsable del almacen
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursals')->cascadeOnDelete()->cascadeOnUpdate(); // sucursal a la que pertenece el almacen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacens');
    }
};
