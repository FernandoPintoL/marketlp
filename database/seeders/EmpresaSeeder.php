<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // empresa market lp
        \App\Models\Empresa::create([
            'name' => 'Market LP',
            'num_id' => '123456789',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '123456789',
            'email' => 'empresa@gmail.com',
            'photo_path' => '',
            'tipo_documento_id' => 1,
            'user_id' => 1,
        ]);
    }
}
