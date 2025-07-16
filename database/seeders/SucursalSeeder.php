<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // sucursal 1
        \App\Models\Sucursal::create([
            'name' => 'Sucursal Principal',
            'direccion' => 'Av. Principal 123',
            'telefono' => '123456789',
            'empresa_id' => 1, // Asignar el ID de la empresa correspondiente
            'empleado_id' => 1, // Asignar el ID del empleado responsable
            'es_matriz' => true,
            'estado' => 'activo',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
    }
}
