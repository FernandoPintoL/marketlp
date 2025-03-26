<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoDocumentos = [
            [
                'sigla' => 'CI',
                'detalle' => 'Carnet de Identidad',
            ],
            [
                'sigla' => 'NIT',
                'detalle' => '(NIT) Número de Identificación Tributaria',
            ],
            [
                'sigla' => 'PAS',
                'detalle' => 'Pasaporte',
            ],
            [
                'sigla' => 'BRE',
                'detalle' => 'Brevet',
            ],
            [
                'sigla' => 'OTRO',
                'detalle' => 'OTROS',
            ],
        ];

        foreach ($tipoDocumentos as $tipoDocumento) {
            \App\Models\TipoDocumento::create($tipoDocumento);
        }
    }
}
