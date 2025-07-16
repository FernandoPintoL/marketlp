<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProforma extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\TipoProformaFactory> */
    use HasFactory, Categorizacion;
    protected $table = "tipo_proformas";
    protected $primaryKey = "id";
    public $timestamps = true;
    public function proformas()
    {
        return $this->hasMany(Proforma::class, 'tipo_proforma_id');
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
