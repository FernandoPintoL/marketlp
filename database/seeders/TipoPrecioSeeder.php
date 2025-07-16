<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tipo de precios para un producto
        $tiposPrecios = [
            [
                'sigla' => 'PVP',
                'detalle' => 'Precio de venta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP2',
                'detalle' => 'Precio de venta por mayor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP3',
                'detalle' => 'Precio de venta especial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP4',
                'detalle' => 'Precio de venta promocional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP5',
                'detalle' => 'Precio de venta con descuento',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP6',
                'detalle' => 'Precio de venta con oferta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP7',
                'detalle' => 'Precio de venta con liquidación',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP8',
                'detalle' => 'Precio de venta con tarifa especial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP9',
                'detalle' => 'Precio de venta con tarifa corporativa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sigla' => 'PVP10',
                'detalle' => 'Precio de venta con tarifa de temporada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($tiposPrecios as $tipoPrecio) {
            \App\Models\TipoPrecio::create($tipoPrecio);
        }
    }
}
