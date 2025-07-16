<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AperturaCaja extends Model
{
    /** @use HasFactory<\Database\Factories\AperturaCajaFactory> */
    use HasFactory;
    protected $table = 'apertura_cajas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'caja_empleado_id',
        'fecha_apertura',
        'hora_apertura',
        'saldo_inicial',
        'saldo_final',
        'estado',
        'observaciones_apertura',
        'observaciones_cierre',
    ];
    public function cajaEmpleado()
    {
        return $this->belongsTo(CajaEmpleado::class, 'caja_empleado_id');
    }
}
