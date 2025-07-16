<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagos extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoPagosFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_pagos";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle'
    ];
    public function pagos()
    {
        return $this->hasMany(Pagos::class, 'tipo_pago_id');
    }
    public function getSigla(): string
    {
        return $this->sigla;
    }
    public function getDetalle(): string
    {
        return $this->detalle;
    }
}
