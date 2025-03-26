<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Alimentos',
            'Bebidas',
            'Limpieza',
            'Cosmeticos',
            'Otros',
            'Tecnologia',
            'Ropa',
            'Calzado',
            'Juguetes',
            'Herramientas',
            'Muebles',
            'Electrodomesticos',
            'Deportes',
            'Mascotas',
            'Libros',
            'Papeleria',
            'Ferreteria',
            'Construccion',
            'Jardineria',
            'Bricolaje'
        ];

        Categoria::create([
            'sigla' => 'Alimentos',
            'detalle' => 'Productos alimenticios',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Bebidas',
            'detalle' => 'Productos bebidas',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Limpieza',
            'detalle' => 'Productos de limpieza',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cosmeticos',
            'detalle' => 'Productos cosmeticos',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Otros',
            'detalle' => 'Otros productos',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Tecnologia',
            'detalle' => 'Productos de tecnologia',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Ropa',
            'detalle' => 'Productos de ropa',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Calzado',
            'detalle' => 'Productos de calzado',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Juguetes',
            'detalle' => 'Productos de juguetes',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Herramientas',
            'detalle' => 'Productos de herramientas',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Muebles',
            'detalle' => 'Productos de muebles',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Electrodomesticos',
            'detalle' => 'Productos de electrodomesticos',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Deportes',
            'detalle' => 'Productos de deportes',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Mascotas',
            'detalle' => 'Productos de mascotas',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Libros',
            'detalle' => 'Productos de libros',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Papeleria',
            'detalle' => 'Productos de papeleria',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Ferreteria',
            'detalle' => 'Productos de ferreteria',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Construccion',
            'detalle' => 'Productos de construccion',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Jardineria',
            'detalle' => 'Productos de jardineria',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Bricolaje',
            'detalle' => 'Productos de bricolaje',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado Personal',
            'detalle' => 'Productos de cuidado personal',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado del Hogar',
            'detalle' => 'Productos de cuidado del hogar',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado del Automovil',
            'detalle' => 'Productos de cuidado del automovil',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de la Ropa',
            'detalle' => 'Productos de cuidado de la ropa',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de la Piel',
            'detalle' => 'Productos de cuidado de la piel',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado del Cabello',
            'detalle' => 'Productos de cuidado del cabello',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de la Boca',
            'detalle' => 'Productos de cuidado de la boca',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de los Ojos',
            'detalle' => 'Productos de cuidado de los ojos',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de las Uñas',
            'detalle' => 'Productos de cuidado de las uñas',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
        Categoria::create([
            'sigla' => 'Cuidado de los Pies',
            'detalle' => 'Productos de cuidado de los pies',
            'created_at' => date_create('now')->format('Y-m-d H:i:s'),
            'updated_at' => date_create('now')->format('Y-m-d H:i:s')
        ]);
    }
}
