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
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->timestamp('fecha')->nullable();
            $table->timestamp('fecha_validez')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('cambio', 12, 2)->default(0);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->string('estado')->nullable();
            $table->string('observaciones')->nullable();
            $table->decimal('tasa_cambio', 12, 6)->default(0);
            $table->decimal('total_moneda_origen', 12, 2)->default(0);
            $table->foreignId('moneda_id')->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('empleado_id')->constrained('empleados')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_proforma_id')->constrained('tipo_proformas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proformas');
    }
};
