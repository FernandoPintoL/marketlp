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
                'detalle' => 'Efectivo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'TARJ',
                'detalle' => 'Tarjeta de Crédito/Débito',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'CHEQ',
                'detalle' => 'Cheque',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'DEP',
                'detalle' => 'Depósito Bancario',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'TRA',
                'detalle' => 'Transferencia Electrónica',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'CRE',
                'detalle' => 'Credito',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'sigla' => 'OTRO',
                'detalle' => 'Otro',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        foreach ($tiposPagos as $tipoPago) {
            \App\Models\TipoPagos::create($tipoPago);
        }
    }
}
