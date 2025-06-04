<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    /** @use HasFactory<\Database\Factories\PagosFactory> */
    use HasFactory;
    protected $table = "pagos";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'tipo_pago_id',
        'moneda_id',
        'apertura_caja_id',
        'fecha_pago',
        'monto',
        'referencia',
        'tasa_cambio',
        'monto_moneda_origen',
        'created_at',
        'updated_at'
    ];
    public function tipoPago()
    {
        return $this->belongsTo(TipoPagos::class, 'tipo_pago_id');
    }
    public function moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
    public function aperturaCaja()
    {
        return $this->belongsTo(AperturaCaja::class, 'apertura_caja_id');
    }
    public function referencia()
    {
        if ($this->referencia_tipo === 'compra') {
            return $this->belongsTo(Compra::class, 'referencia_id');
        } elseif ($this->referencia_tipo === 'venta') {
            return $this->belongsTo(Venta::class, 'referencia_id');
        } elseif ($this->referencia_tipo === 'arqueo_caja') {
            return $this->belongsTo(ArqueoCaja::class, 'referencia_id');
        }
        return null;
    }
}
