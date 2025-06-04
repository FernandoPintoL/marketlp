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
        Schema::create('caja_empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caja_id')->constrained('cajas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained('empleados')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('fecha_asignacion')->nullable()->default(now());
            $table->string('estado')->default('ACTIVO'); // ACTIVO, INACTIVO, ELIMINADO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_empleados');
    }
};
