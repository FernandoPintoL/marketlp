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
        'caja_id',
        'empleado_id',
        'fecha_apertura',
        'hora_apertura',
        'saldo_inicial',
        'saldo_final',
        'estado',
        'observaciones_apertura',
        'observaciones_cierre',
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
