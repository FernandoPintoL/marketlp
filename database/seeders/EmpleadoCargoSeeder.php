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
                'sigla' => 'Gerente',
                'detalle' => 'Gerente General',
            ],
            [
                'sigla' => 'Asistente',
                'detalle' => 'Asistente Administrativo',
            ],
            [
                'sigla' => 'Contador',
                'detalle' => 'Contador General',
            ],
            [
                'sigla' => 'Vendedor',
                'detalle' => 'Vendedor de Tienda',
            ],
            [
                'sigla' => 'Otro',
                'detalle' => 'Otro',
            ],
            [
                'sigla' => 'Almacenista',
                'detalle' => 'Almacenista',
            ],
            [
                'sigla' => 'Chofer',
                'detalle' => 'Chofer',
            ],
            [
                'sigla' => 'Tecnico',
                'detalle' => 'Tecnico de Servicio',
            ],
            [
                'sigla' => 'Jefe de Almacen',
                'detalle' => 'Jefe de Almacen',
            ],
            [
                'sigla' => 'Jefe de Ventas',
                'detalle' => 'Jefe de Ventas',
            ],
            [
                'sigla' => 'Jefe de Compras',
                'detalle' => 'Jefe de Compras',
            ],
            [
                'sigla' => 'Jefe de Recursos Humanos',
                'detalle' => 'Jefe de Recursos Humanos',
            ],
            [
                'sigla' => 'Jefe de Sistemas',
                'detalle' => 'Jefe de Sistemas',
            ],
            [
                'sigla' => 'Jefe de Marketing',
                'detalle' => 'Jefe de Marketing',
            ],
            [
                'sigla' => 'Jefe de Produccion',
                'detalle' => 'Jefe de Produccion',
            ],
            [
                'sigla' => 'Jefe de Calidad',
                'detalle' => 'Jefe de Calidad',
            ],
            [
                'sigla' => 'Jefe de Logistica',
                'detalle' => 'Jefe de Logistica',
            ],
            [
                'sigla' => 'Jefe de Seguridad',
                'detalle' => 'Jefe de Seguridad',
            ],
            [
                'sigla' => 'Jefe de Mantenimiento',
                'detalle' => 'Jefe de Mantenimiento',
            ],
            [
                'sigla' => 'Jefe de Proyectos',
                'detalle' => 'Jefe de Proyectos',
            ],
            [
                'sigla' => 'Jefe de Compras Internacionales',
                'detalle' => 'Jefe de Compras Internacionales',
            ],
            [
                'sigla' => 'Jefe de Ventas Internacionales',
                'detalle' => 'Jefe de Ventas Internacionales',
            ],
            [
                'sigla' => 'Jefe de Finanzas',
                'detalle' => 'Jefe de Finanzas',
            ],
            [
                'sigla' => 'Jefe de Administracion',
                'detalle' => 'Jefe de Administracion',
            ],
            [
                'sigla' => 'Jefe de Tecnologia',
                'detalle' => 'Jefe de Tecnologia',
            ],
            [
                'sigla' => 'Jefe de Innovacion',
                'detalle' => 'Jefe de Innovacion',
            ],
            [
                'sigla' => 'Jefe de Desarrollo',
                'detalle' => 'Jefe de Desarrollo',
            ],
            [
                'sigla' => 'Jefe de Investigacion',
                'detalle' => 'Jefe de Investigacion',
            ],
        ];
        foreach ($empleadoCargos as $empleadoCargo) {
            \App\Models\EmpleadoCargo::create($empleadoCargo);
        }
    }
}
