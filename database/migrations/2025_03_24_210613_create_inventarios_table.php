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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained("items")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('almacen_id')->constrained("almacens")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ubicacion_item_id')->nullable()->constrained("ubicacion_items")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('lote')->default('Sin lote')->nullable();
            $table->date('fecha_vencimiento')->default(now())->nullable();
            $table->decimal('cantidad_disponible', 10, 2)->default(0);
            $table->decimal('cantidad_reservada', 10, 2)->default(0);
            $table->decimal('cantidad_apartada', 10, 2)->default(0);
            $table->timestamp('fecha_ultima_actualizacion')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
