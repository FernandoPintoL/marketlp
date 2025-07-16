<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // nombre para sectores de almacenes
        $sectores = [
            [
                'almacen_id' => 1,
                'codigo' => 'A1',
                'name' => 'Sector de Bebidas',
                'descripcion' => 'Sector destinado al almacenamiento de bebidas, incluyendo refrescos, jugos y aguas.',
                'maximo' => 100,
                'minimo' => 10,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'almacen_id' => 1,
                'codigo' => 'A2',
                'name' => 'Sector de Alimentos Secos',
                'descripcion' => 'Sector destinado al almacenamiento de alimentos secos, como arroz, pasta y legumbres.',
                'maximo' => 200,
                'minimo' => 20,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'almacen_id' => 1,
                'codigo' => 'A3',
                'name' => 'Sector de Productos Frescos',
                'descripcion' => 'Sector destinado al almacenamiento de productos frescos, como frutas y verduras.',
                'maximo' => 150,
                'minimo' => 15,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'almacen_id' => 1,
                'codigo' => 'A4',
                'name' => 'Sector de Productos Congelados',
                'descripcion' => 'Sector destinado al almacenamiento de productos congelados, como helados y carnes.',
                'maximo' => 80,
                'minimo' => 8,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'almacen_id' => 1,
                'codigo' => 'A5',
                'name' => 'Sector de Productos de Limpieza',
                'descripcion' => 'Sector destinado al almacenamiento de productos de limpieza y desinfección.',
                'maximo' => 120,
                'minimo' => 12,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
            [
                'almacen_id' => 1,
                'codigo' => 'A6',
                'name' => 'Sector de Productos de Higiene Personal',
                'descripcion' => 'Sector destinado al almacenamiento de productos de higiene personal, como jabones y champús.',
                'maximo' => 90,
                'minimo' => 9,
                'created_at' => date_create('now')->format('Y-m-d H:i:s'),
                'updated_at' => date_create('now')->format('Y-m-d H:i:s')
            ],
        ];
        foreach ($sectores as $sector) {
            Sector::create($sector);
        }
    }
}
