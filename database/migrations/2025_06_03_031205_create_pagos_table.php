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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('moneda_id')->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('apertura_caja_id')->nullable()->constrained('apertura_cajas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha_pago')->nullable();
            $table->decimal('monto', 12, 2)->default(0);
            $table->string('referencia')->nullable();
            $table->decimal('tasa_cambio', 12, 6)->default(0);
            $table->decimal('monto_moneda_origen', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
