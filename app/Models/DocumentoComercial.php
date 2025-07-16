<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoComercial extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoComercialFactory> */
    use HasFactory;
    protected $table = 'documento_comercials';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'fecha',
        'total',
        'total_recibido',
        'saldo_pendiente',
        'cambio',
        'descuento',
        'observaciones',
        'estado',
        'tasa_cambio',
        'total_moneda_origen',
        'moneda_id',
        'cliente_id',
        'proveedor_id',
        'empleado_id',
        'tipo_pago_id',
        'tipo_documento_comercials_id'
    ];
}
