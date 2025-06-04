<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // monedas
        $monedas = [
            [
                'codigo' => 'BOB',
                'nombre' => 'Boliviano',
                'simbolo' => 'BS',
                'es_moneda_local' => true,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'USD',
                'nombre' => 'Dólar Estadounidense',
                'simbolo' => '$',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'EUR',
                'nombre' => 'Euro',
                'simbolo' => '€',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'GBP',
                'nombre' => 'Libra Esterlina',
                'simbolo' => '£',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'JPY',
                'nombre' => 'Yen Japonés',
                'simbolo' => '¥',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'CNY',
                'nombre' => 'Yuan Chino',
                'simbolo' => '¥',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'ARS',
                'nombre' => 'Peso Argentino',
                'simbolo' => '$',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
            [
                'codigo' => 'BRL',
                'nombre' => 'Real Brasileño',
                'simbolo' => 'R$',
                'es_moneda_local' => false,
                'estado' => 'activo',
            ],
        ];
        foreach ($monedas as $moneda) {
            \App\Models\Moneda::updateOrCreate($moneda,
                [
                    'codigo' => $moneda['codigo'],
                    'nombre' => $moneda['nombre'],
                    'simbolo' => $moneda['simbolo'],
                    'es_moneda_local' => $moneda['es_moneda_local'],
                    'estado' => $moneda['estado'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
