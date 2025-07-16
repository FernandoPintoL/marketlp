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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('num_id')->unique();
            $table->string("direccion")->nullable();
            $table->string("telefono")->nullable();
            $table->timestamps();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('empleado_cargo_id')->constrained('empleado_cargos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
