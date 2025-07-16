<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoMovimientoFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_movimientos";
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
}
