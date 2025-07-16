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
        Schema::create('arqueo_cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apertura_caja_id')->constrained('apertura_cajas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('empleado_id')->constrained('empleados')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('fecha_arqueo')->default(now());
            $table->decimal('total_effective', 12, 2)->default(0.00);
            $table->decimal('total_tarjetas', 12, 2)->default(0.00);
            $table->decimal('total_transferencias', 12, 2)->default(0.00);
            $table->decimal('total_cheques', 12, 2)->default(0.00);
            $table->decimal('total_otros', 12, 2)->default(0.00);
            $table->decimal('diferencia', 12, 2)->default(0.00);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arqueo_cajas');
    }
};
