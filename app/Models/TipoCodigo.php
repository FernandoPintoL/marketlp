<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCodigo extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoCodigoFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_codigos";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function codigos()
    {
        return $this->hasMany(CodigoItems::class, 'tipo_codigo_id');
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
