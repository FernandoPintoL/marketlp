<?php

namespace App\Models;

use App\Interfaz\CategorizacionInterface;
use App\Traits\Categorizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model implements CategorizacionInterface
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory, Categorizacion;
    protected $table = "categorias";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle'
    ];
    public function getSigla(): string
    {
        return $this->sigla;
    }
    public function getDetalle(): string
    {
        return $this->detalle;
    }
}
