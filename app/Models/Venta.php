<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    /** @use HasFactory<\Database\Factories\VentaFactory> */
    use HasFactory;
    protected $table = "ventas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'fecha',
        'total',
        'total_recibido',
        'cambio',
        'descuento',
        'saldo_pendiente',
        'observaciones',
        'estado',
        'tasa_cambio',
        'total_moneda_origen',
        'moneda_id',
        'cliente_id',
        'empleado_id',
        'tipo_pago_id',
        'proforma_id',
        'caja_id',
        'apertura_caja_id',
        'created_at',
        'updated_at'
    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function tipoPago()
    {
        return $this->belongsTo(TipoPagos::class, 'tipo_pago_id');
    }
    public function moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
    public function proforma()
    {
        return $this->belongsTo(Proforma::class, 'proforma_id');
    }
    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    public function aperturaCaja()
    {
        return $this->belongsTo(AperturaCaja::class, 'apertura_caja_id');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
