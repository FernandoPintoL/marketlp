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
        Schema::create('apertura_cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caja_empleado_id')->constrained('caja_empleados')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('fecha_apertura')->default(now());
            $table->timestamp('fecha_cierre')->nullable();
            $table->decimal('saldo_inicial', 12, 2)->default(0.00);
            $table->decimal('saldo_final', 12, 2)->default(0.00);
            $table->string('estado')->default('ABIERTO'); // ABIERTO, CERRADO, ANULADO
            $table->string('observaciones_apertura')->nullable();
            $table->string('observaciones_cierre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apertura_cajas');
    }
};
