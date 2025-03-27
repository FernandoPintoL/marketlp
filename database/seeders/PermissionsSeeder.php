<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrays_permisos = [
            'ajuste',
            'almacen',
            'categoria',
            'cliente',
            'empleado',
            'empleado-cargo',
            'empresa',
            'inventario',
            'item',
            'menu',
            'permissions',
            'proveedor',
            'roles',
            'sector',
            'tipo-documento',
            'unidad',
            'users'
        ];

        // Crear permisos para cada elemento en el array
        foreach ($arrays_permisos as $permiso) {
            Permission::create(['name' => $permiso . '-list']);
            Permission::create(['name' => $permiso . '-create']);
            Permission::create(['name' => $permiso . '-store']);
            Permission::create(['name' => $permiso . '-edit']);
            Permission::create(['name' => $permiso . '-update']);
            Permission::create(['name' => $permiso . '-delete']);
            Permission::create(['name' => $permiso . '-index']);
            Permission::create(['name' => $permiso . '-show']);
        }
    }
}
