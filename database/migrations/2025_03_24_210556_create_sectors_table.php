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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almacen_id')->constrained("almacens")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('codigo')->default('Sin nombre');
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->double('maximo')->default(0)->nullable();
            $table->double('minimo')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
