<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tipo de pagos
        $tiposPagos = [
            [
                'sigla' => 'EFEC',
                'detalle' => 'Efectivo'
            ],
            [
                'sigla' => 'TARJ',
                'detalle' => 'Tarjeta de Crédito/Débito'
            ],
            [
                'sigla' => 'CHEQ',
                'detalle' => 'Cheque'
            ],
            [
                'sigla' => 'DEP',
                'detalle' => 'Depósito Bancario'
            ],
            [
                'sigla' => 'TRA',
                'detalle' => 'Transferencia Electrónica'
            ],
            [
                'sigla' => 'CRE',
                'detalle' => 'Credito'
            ],
            [
                'sigla' => 'OTRO',
                'detalle' => 'Otro'
            ]
        ];
        foreach ($tiposPagos as $tipoPago) {
            \App\Models\TipoPagos::create($tipoPago);
        }
    }
}
