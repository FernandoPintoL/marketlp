<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // movimientos de items en almacen e inventario
        $tiposMovimiento = [
            [
                'sigla' => 'ENTRADA',
                'detalle' => 'Entrada de inventario'],
            [
                'sigla' => 'SALIDA',
                'detalle' => 'Salida de inventario'],
            [
                'sigla' => 'TRASLADO',
                'detalle' => 'Traslado entre almacenes'],
            [
                'sigla' => 'AJUSTE',
                'detalle' => 'Ajuste de inventario'],
        ];
        foreach ($tiposMovimiento as $tipo) {
            \App\Models\TipoMovimiento::create($tipo);
        }
    }
}
