<?php

namespace Database\Seeders;

use App\Models\Almacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //almacenes para prodcuctos
        Almacen::create([
            'empleado_id' => 1,
            'sigla' => 'ALM',
            'name' => 'Almacen Principal',
            'direccion' => 'Av. Principal 123',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s'),
            'sucursal_id' => 1
        ]);

        Almacen::create([
            'empleado_id' => 1,
            'sigla' => 'SVT',
            'name' => 'Sala de Ventas',
            'direccion' => 'Av. Principal 123',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s'),
            'sucursal_id' => 1
        ]);
    }
}
