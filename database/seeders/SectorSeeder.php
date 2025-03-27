<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // nombre para sectores de almacenes
        $sectores = [
            [
                'sigla' => 'A1',
                'detalle' => 'Sector de Bebidas',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'sigla' => 'A2',
                'detalle' => 'Sector de Alimentos',
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ]
        ];

        \DB::table('sectors')->insert($sectores);
    }
}
