<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoDocumentoFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_documentos";
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
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'tipo_documento_id');
    }
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_documento_id');
    }
    public function usuarios()
    {
        return $this->hasMany(User::class, 'tipo_documento_id');
    }
}
