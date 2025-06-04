<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    /** @use HasFactory<\Database\Factories\MovimientoCajaFactory> */
    use HasFactory;
    protected $table = "movimiento_cajas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'apertura_caja_id',
        'tipo_movimiento_id',
        'monto',
        'moneda_id',
        'tasa_cambio',
        'monto_moneda_local',
        'fecha_movimiento',
        'observaciones',
        'referencia_id',
        'tipo_referencia',
        'tipo_pago_id',
        'created_at',
        'updated_at'
    ];
    public function aperturaCaja()
    {
        return $this->belongsTo(AperturaCaja::class, 'apertura_caja_id');
    }
    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento_id');
    }
    public function moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
    public function tipoPago()
    {
        return $this->belongsTo(TipoPagos::class, 'tipo_pago_id');
    }
    public function referencia()
    {
        if ($this->tipo_referencia === 'compra') {
            return $this->belongsTo(Compra::class, 'referencia_id');
        } elseif ($this->tipo_referencia === 'arqueo_caja') {
            return $this->belongsTo(ArqueoCaja::class, 'referencia_id');
        } elseif ($this->tipo_referencia === 'apertura_caja') {
            return $this->belongsTo(AperturaCaja::class, 'referencia_id');
        }
        return null;
    }
}
