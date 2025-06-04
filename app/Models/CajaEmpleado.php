<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaEmpleado extends Model
{
    /** @use HasFactory<\Database\Factories\CajaEmpleadoFactory> */
    use HasFactory;
    protected $table = 'caja_empleados';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'caja_id',
        'empleado_id',
        'fecha_asignacion',
        'estado',
        'created_at',
        'updated_at',
    ];
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
