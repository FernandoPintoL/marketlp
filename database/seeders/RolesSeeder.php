<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Compras']);
        Role::create(['name' => 'Almacen']);
        Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Proveedor']);
        Role::create(['name' => 'Empleado']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Gerente']);
        Role::create(['name' => 'Contador']);
        Role::create(['name' => 'Asistente']);
        Role::create(['name' => 'Jefe de Almacen']);
        Role::create(['name' => 'Jefe de Ventas']);
        Role::create(['name' => 'Jefe de Compras']);

        // Asignar permisos al rol de Super Admin
        $admin->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole([$admin]);
    }
}
