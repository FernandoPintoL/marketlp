<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUbicacionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ubicaciones para productos e items
        $tipo_ubicacion_items = [
            ['sigla' => 'Almacen', 'detalle' => 'Ubicacion de almacen'],
            ['sigla' => 'Tienda', 'detalle' => 'Ubicacion de tienda'],
            ['sigla' => 'Deposito', 'detalle' => 'Ubicacion de deposito']
        ];
        foreach ($tipo_ubicacion_items as $tipo_ubicacion_item) {
            \App\Models\TipoUbicacionItem::create($tipo_ubicacion_item);
        }
    }
}
