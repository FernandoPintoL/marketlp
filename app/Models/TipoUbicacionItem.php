<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbicacionItem extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoUbicacionItemFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_ubicacion_items";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function ubicaciones()
    {
        return $this->hasMany(UbicacionItem::class, 'tipo_ubicacion_id');
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
