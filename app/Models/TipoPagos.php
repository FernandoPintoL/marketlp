<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagos extends Model
{
    /** @use HasFactory<\Database\Factories\TipoPagosFactory> */
    use HasFactory;
    protected $table = "tipo_pagos";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'tipo_pago_id');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'tipo_pago_id');
    }
    public function compras()
    {
        return $this->hasMany(Compra::class, 'tipo_pago_id');
    }
}
