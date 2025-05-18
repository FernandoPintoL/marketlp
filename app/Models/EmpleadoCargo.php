<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoCargo extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoCargoFactory> */
    use HasFactory;
    protected $table = "empleado_cargos";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
