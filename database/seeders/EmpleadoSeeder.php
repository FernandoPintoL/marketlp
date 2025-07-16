<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // empleados
        $empleados = [
            [
                'name' => 'Juan Perez',
                'num_id' => '123456789',
                'tipo_documento_id' => 1, // Assuming 1 is the ID for 'DNI'
                'direccion' => 'Calle Falsa 123',
                'telefono' => '1234567890',
                'empleado_cargo_id' => 1, // Assuming 1 is the ID for 'Gerente'
                'user_id' => 1, // Assuming 1 is the ID for an existing user
                'empresa_id' => 1 // Assuming 1 is the ID for an existing company
            ]
        ];
        foreach ($empleados as $empleado) {
            \App\Models\Empleado::create($empleado);
        }
    }
}
