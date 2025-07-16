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
        Schema::create('movimiento_cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apertura_caja_id')->constrained('apertura_cajas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tipo_movimiento_id')->constrained('tipo_movimientos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('monto', 12, 2)->default(0.00);
            $table->decimal('tasa_cambio', 12, 6)->default(1.00);
            $table->decimal('monto_moneda_local', 12, 2)->default(0.00);
            $table->timestamp('fecha_movimiento')->default(now());
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->string('tipo_referencia')->nullable(); // Puede ser 'venta', 'compra', 'gasto', etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_cajas');
    }
};
