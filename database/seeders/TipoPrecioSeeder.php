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
                'detalle' => 'Precio de venta'
            ],
            [
                'sigla' => 'PVP2',
                'detalle' => 'Precio de venta por mayor'
            ],
            [
                'sigla' => 'PVP3',
                'detalle' => 'Precio de venta especial'
            ],
            [
                'sigla' => 'PVP4',
                'detalle' => 'Precio de venta promocional'
            ],
            [
                'sigla' => 'PVP5',
                'detalle' => 'Precio de venta con descuento'
            ],
            [
                'sigla' => 'PVP6',
                'detalle' => 'Precio de venta con oferta'
            ],
            [
                'sigla' => 'PVP7',
                'detalle' => 'Precio de venta con liquidación'
            ],
            [
                'sigla' => 'PVP8',
                'detalle' => 'Precio de venta con tarifa especial'
            ],
            [
                'sigla' => 'PVP9',
                'detalle' => 'Precio de venta con tarifa corporativa'
            ],
            [
                'sigla' => 'PVP10',
                'detalle' => 'Precio de venta con tarifa de temporada'
            ],
        ];
        foreach ($tiposPrecios as $tipoPrecio) {
            \App\Models\TipoPrecio::create($tipoPrecio);
        }
    }
}
