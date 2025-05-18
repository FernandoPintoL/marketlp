<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;
    protected $table = "empresas";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'name',
        'num_id',
        'telefono',
        'email',
        'direccion',
        'tipo_empresa',
        'tipo_documento',
        'photo_path',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
