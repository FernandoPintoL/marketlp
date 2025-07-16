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
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('name');
            $table->string('estado')->default('ACTIVO');
            $table->timestamps();
            $table->foreignId('empleado_id')->nullable()->constrained('empleados')->cascadeOnDelete()->cascadeOnUpdate(); // responsable de la caja
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursals')->cascadeOnDelete()->cascadeOnUpdate(); // sucursal a la que pertenece la caja
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
