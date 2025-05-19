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
        Schema::create('codigo_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('tipo_codigo_id')->nullable();
            $table->string('codigo')->default('');
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('tipo_codigo_id')->references('id')->on('tipo_codigos')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigo_items');
    }
};
