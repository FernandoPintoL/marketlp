<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProformaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tipo proforma
        $tiposProforma = [
            [
                'sigla' => 'Proforma',
                'detalle' => 'Proforma de venta'
            ],
            [
                'sigla' => 'Proforma de compra',
                'detalle' => 'Proforma de compra'
            ],
            [
                'sigla' => 'Proforma de servicio',
                'detalle' => 'Proforma de servicio'
            ],
        ];
        foreach ($tiposProforma as $tipo) {
            \App\Models\TipoProforma::create($tipo);
        }
    }
}
