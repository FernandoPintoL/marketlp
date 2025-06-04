<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCodigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // tipos de codigos para item
        $tipos_codigos = [
            [
                'sigla' => 'QR',
                'detalle' => 'Código QR para productos'],
            [
                'sigla' => 'BARRA',
                'detalle' => 'Código de barras para productos'],
        ];
        foreach ($tipos_codigos as $tipo_codigo) {
            \App\Models\TipoCodigo::create($tipo_codigo);
        }
    }
}
