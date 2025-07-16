<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\UnidadFactory> */
    use HasFactory, Categorizacion;
    protected $table = "unidads";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function items()
    {
        return $this->hasMany(Item::class, 'unidad_id');
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
