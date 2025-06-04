<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;
    protected $table = "compras";
    protected $primaryKey = "id";
    protected $fillable = [
        'codigo',
        'fecha',
        'total',
        'total_pagado',
        'saldo_pendiente',
        'observaciones',
        'estado',
        'tasa_cambio',
        'total_moneda_origen',
        'moneda_id',
        'proveedor_id',
        'empleado_id',
        'tipo_pago_id',
        'tipo_cambio_id',
        'created_at',
        'updated_at'
    ];
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
    public function tipoPago()
    {
        return $this->belongsTo(TipoPagos::class, 'tipo_pago_id');
    }
    public function tipoCambio()
    {
        return $this->belongsTo(TipoCambio::class, 'tipo_cambio_id');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }
}
