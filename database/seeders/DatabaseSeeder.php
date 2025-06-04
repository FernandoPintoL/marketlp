<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'usernick' => 'administrador',
            'password' => Hash::make('123456789'),
            "created_at" => date_create('now')->format('Y-m-d H:i:s'),
            "updated_at" => date_create('now')->format('Y-m-d H:i:s')
        ]);


        $this->call([
            TipoDocumentoSeeder::class,
            EmpresaSeeder::class,
            EmpleadoCargoSeeder::class,
            EmpleadoSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            SucursalSeeder::class,
            AlmacenSeeder::class,
            SectorSeeder::class,
            CategoriaSeeder::class,
            UnidadSeeder::class,
            MenuSeeder::class,
            MonedaSeeder::class,
            TipoCambioSeeder::class,
            TipoCodigoSeeder::class,
            TipoMovimientoSeeder::class,
            TipoPagosSeeder::class,
            TipoPrecioSeeder::class,
            TipoProformaSeeder::class,
            TipoUbicacionItemSeeder::class,
        ]);
    }
}
