<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentoComercial extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoDocumentoComercialFactory> */
    use HasFactory, Categorizacion;
    protected $table = 'tipo_documento_comercials';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'estado'
    ];
    public function getSigla(): string
    {
        return $this->sigla;
    }
    public function getDetalle(): string
    {
        return $this->detalle;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
}
