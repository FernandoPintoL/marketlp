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
        Schema::create('precio_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('tipo_precio_id')->nullable();
            $table->double('precio')->default(0);
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('tipo_precio_id')->references('id')->on('tipo_precios')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precio_items');
    }
};
