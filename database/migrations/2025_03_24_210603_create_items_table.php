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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('cod_barra')->default('0000000000000')->nullable();
            $table->string('name')->default('Item')->nullable();
            $table->string('descripcion')->default(' ')->nullable();
            $table->string('photo_path')->default(' ')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('unidad_id')->nullable();
            $table->timestamps();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null')->onUpdate('set null');
            $table->foreign('unidad_id')->references('id')->on('unidads')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
