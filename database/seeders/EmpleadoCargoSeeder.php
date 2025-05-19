<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // crear seeders para tipos de empleados
        $empleadoCargos = [
            [
                'cargo' => 'Gerente',
                'detalle' => 'Gerente General',
            ],
            [
                'cargo' => 'Asistente',
                'detalle' => 'Asistente Administrativo',
            ],
            [
                'cargo' => 'Contador',
                'detalle' => 'Contador General',
            ],
            [
                'cargo' => 'Vendedor',
                'detalle' => 'Vendedor de Tienda',
            ],
            [
                'cargo' => 'Otro',
                'detalle' => 'Otro',
            ],
            [
                'cargo' => 'Almacenista',
                'detalle' => 'Almacenista',
            ],
            [
                'cargo' => 'Chofer',
                'detalle' => 'Chofer',
            ],
            [
                'cargo' => 'Tecnico',
                'detalle' => 'Tecnico de Servicio',
            ],
            [
                'cargo' => 'Jefe de Almacen',
                'detalle' => 'Jefe de Almacen',
            ],
            [
                'cargo' => 'Jefe de Ventas',
                'detalle' => 'Jefe de Ventas',
            ],
            [
                'cargo' => 'Jefe de Compras',
                'detalle' => 'Jefe de Compras',
            ],
            [
                'cargo' => 'Jefe de Recursos Humanos',
                'detalle' => 'Jefe de Recursos Humanos',
            ],
            [
                'cargo' => 'Jefe de Sistemas',
                'detalle' => 'Jefe de Sistemas',
            ],
            [
                'cargo' => 'Jefe de Marketing',
                'detalle' => 'Jefe de Marketing',
            ],
            [
                'cargo' => 'Jefe de Produccion',
                'detalle' => 'Jefe de Produccion',
            ],
            [
                'cargo' => 'Jefe de Calidad',
                'detalle' => 'Jefe de Calidad',
            ],
            [
                'cargo' => 'Jefe de Logistica',
                'detalle' => 'Jefe de Logistica',
            ],
            [
                'cargo' => 'Jefe de Seguridad',
                'detalle' => 'Jefe de Seguridad',
            ],
            [
                'cargo' => 'Jefe de Mantenimiento',
                'detalle' => 'Jefe de Mantenimiento',
            ],
            [
                'cargo' => 'Jefe de Proyectos',
                'detalle' => 'Jefe de Proyectos',
            ],
            [
                'cargo' => 'Jefe de Compras Internacionales',
                'detalle' => 'Jefe de Compras Internacionales',
            ],
            [
                'cargo' => 'Jefe de Ventas Internacionales',
                'detalle' => 'Jefe de Ventas Internacionales',
            ],
            [
                'cargo' => 'Jefe de Finanzas',
                'detalle' => 'Jefe de Finanzas',
            ],
            [
                'cargo' => 'Jefe de Administracion',
                'detalle' => 'Jefe de Administracion',
            ],
            [
                'cargo' => 'Jefe de Tecnologia',
                'detalle' => 'Jefe de Tecnologia',
            ],
            [
                'cargo' => 'Jefe de Innovacion',
                'detalle' => 'Jefe de Innovacion',
            ],
            [
                'cargo' => 'Jefe de Desarrollo',
                'detalle' => 'Jefe de Desarrollo',
            ],
            [
                'cargo' => 'Jefe de Investigacion',
                'detalle' => 'Jefe de Investigacion',
            ],
        ];
        foreach ($empleadoCargos as $empleadoCargo) {
            \App\Models\EmpleadoCargo::create($empleadoCargo);
        }
    }
}
