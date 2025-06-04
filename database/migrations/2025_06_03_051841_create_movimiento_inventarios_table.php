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
        Schema::create('movimiento_inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()->constrained('items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('almacen_origen_id')->nullable()->constrained('almacens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('almacen_destino_id')->nullable()->constrained('almacens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ubicacion_origen_item_id')->nullable()->constrained('ubicacion_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ubicacion_destino_item_id')->nullable()->constrained('ubicacion_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_movimiento_id')->nullable()->constrained('tipo_movimientos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('cantidad', 10, 3)->default(0);
            $table->timestamp('fecha_movimiento')->default(now());
            $table->unsignedBigInteger('referencia_id')->nullable(); // FK a factura, orden, etc.
            $table->string('referencia_tipo')->nullable(); // Tipo de referencia (factura, orden, etc.)
            $table->string('lote')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('usuario_responsable')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventarios');
    }
};
