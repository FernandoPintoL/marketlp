<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrays_menus = [
            [
                'title' => 'Dashboard',
                'href' => 'dashboard',
                'icon' => "fa-solid fa-house"
            ],
            [
                'title' => 'Almacen',
                'href' => 'almacen.index',
                'icon' => "fa-solid fa-warehouse"
            ],
            [
                'title' => 'Categoria',
                'href' => 'categoria.index',
                'icon' => "fa-solid fa-layer-group"
            ],
            [
                'title' => 'Cliente',
                'href' => 'cliente.index',
                'icon' => "fa-solid fa-person-shelter"
            ],
            [
                'title' => 'Empleado',
                'href' => 'empleado.index',
                'icon' => "fa-solid fa-user-shield"
            ],
            [
                'title' => 'Cargo del Empleado',
                'href' => 'empleado-cargo.index',
                'icon' => "fa-solid fa-users-rays"
            ],
            [
                'title' => 'Empresa',
                'href' => 'empresa.index',
                'icon' => "fa-solid fa-building"
            ],
            [
                'title' => 'Inventario',
                'href' => 'inventario.index',
                'icon' => "fa-solid fa-money-bill-trend-up"
            ],
            [
                'title' => 'Item',
                'href' => 'item.index',
                'icon' => "fa-solid fa-store"
            ],
            [
                'title' => 'Menu',
                'href' => 'menu.index',
                'icon' => "fa-solid fa-bars"
            ],
            [
                'title' => 'Permisos',
                'href' => 'permissions.index',
                'icon' => "fa-solid fa-key"
            ],
            [
                'title' => 'Proveedores',
                'href' => 'proveedor.index',
                'icon' => "fa-solid fa-user-tie"
            ],
            [
                'title' => 'Role',
                'href' => 'roles.index',
                'icon' => "fa-solid fa-key"
            ],
            [
                'title' => 'Sectores',
                'href' => 'sector.index',
                'icon' => "fa-solid fa-rectangle-list"
            ],
            [
                'title' => 'Tipos Documentos',
                'href' => 'tipo-documento.index',
                'icon' => "fa-solid fa-file"
            ],
            [
                'title' => 'Unidades',
                'href' => 'unidad.index',
                'icon' => "fa-solid fa-bars-staggered"
            ],
            [
                'title' => 'Usuarios',
                'href' => 'users.index',
                'icon' => "fa-solid fa-circle-user"
            ]
        ];


        foreach ($arrays_menus as $menu) {
            Menu::create([
                'title' => $menu['title'],
                'href' =>  $menu['href'],
                'icon' => $menu['icon'],
                'isMain' => 1,
            ]);
        }
    }
}
