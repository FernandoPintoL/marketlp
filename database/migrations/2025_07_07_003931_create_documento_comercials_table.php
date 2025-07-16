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
        Schema::create('documento_comercials', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->timestamp('fecha')->default(now())->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('total_recibido', 12, 2)->default(0);
            $table->decimal('saldo_pendiente', 12, 2)->default(0);
            $table->decimal('cambio', 12, 2)->default(0);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->string('observaciones')->nullable();
            $table->string('estado')->default('PENDIENTE');
            $table->decimal('tasa_cambio', 12, 6)->default(0);
            $table->decimal('total_moneda_origen', 12, 2)->default(0);
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('empleado_id')->nullable()->constrained('empleados')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('moneda_id')->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_documento_comercials_id')->constrained('tipo_documento_comercials')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_comercials');
    }
};
