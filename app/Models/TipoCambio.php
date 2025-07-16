<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoCambioFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_cambios";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function getSigla(): string
    {
        return $this->sigla;
    }
    public function getDetalle(): string
    {
        return $this->detalle;
    }
    public function monedaOrigen()
    {
        return $this->belongsTo(Moneda::class, 'moneda_origen_id');
    }
    public function monedaDestino()
    {
        return $this->belongsTo(Moneda::class, 'moneda_destino_id');
    }
}
