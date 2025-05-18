<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoFactory> */
    use HasFactory;
    protected $table = "empleados";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'name',
        'num_id',
        'tipo_documento_id',
        'direccion',
        'telefono',
        'email',
        'empleado_cargo_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
