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
        Schema::create('tipo_cambios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moneda_origen_id')->nullable()->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('moneda_destino_id')->nullable()->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('fecha')->nullable();
            $table->decimal('tasa_cambio', 12, 6)->default(1.0000);
            $table->decimal('tasa_inversa', 12, 6)->default(1.0000);
            $table->string('fuente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_cambios');
    }
};
