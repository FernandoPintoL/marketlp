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
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empleado_cargo_id', 'id');
    }
}
