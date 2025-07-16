<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrecio extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoPrecioFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_precios";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function items()
    {
        return $this->hasMany(Item::class, 'tipo_precio_id');
    }
    public function precios()
    {
        return $this->hasMany(PrecioItems::class, 'tipo_precio_id');
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
