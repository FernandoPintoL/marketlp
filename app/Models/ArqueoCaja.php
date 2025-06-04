<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArqueoCaja extends Model
{
    /** @use HasFactory<\Database\Factories\ArqueoCajaFactory> */
    use HasFactory;
    protected $table = 'arqueo_cajas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'apertura_caja_id',
        'empleado_id',
        'fecha_arqueo',
        'total_efectivo',
        'total_tarjeta',
        'total_transferencias',
        'total_cheques',
        'total_otros',
        'diferencia',
        'observaciones',
        'created_at',
        'updated_at',
    ];
    public function aperturaCaja()
    {
        return $this->belongsTo(AperturaCaja::class, 'apertura_caja_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
