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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Sin nombre');
            $table->string('num_id')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('contacto')->nullable();
            $table->unsignedBigInteger('tipo_documento_id')->nullable();
            $table->timestamps();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')->onDelete('set null');
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
