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
        Schema::create('ubicacion_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('sectors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_ubicacion_items_id')->nullable()->constrained('tipo_ubicacion_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('codigo')->default('Almacen sin nombre');
            $table->decimal('capacidad', 10, 2)->default(0);
            $table->string('estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion_items');
    }
};
