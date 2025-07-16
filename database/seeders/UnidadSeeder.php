<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrays_unidad = [
            [
                'detalle' => 'Unidad',
                'sigla' => 'UN',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'detalle' => 'Caja',
                'sigla' => 'CJ',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'detalle' => 'Paquete',
                'sigla' => 'PQT',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'detalle' => 'Docena',
                'sigla' => 'DZ',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'detalle' => 'Kilogramo',
                'sigla' => 'KG',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'detalle' => 'Litro',
                'sigla' => 'LT',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ]
        ];
        foreach ($arrays_unidad as $unidad) {
            \App\Models\Unidad::create($unidad);
        }
    }
}
