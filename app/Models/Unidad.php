<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadFactory> */
    use HasFactory;
    protected $table = "unidads";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function items()
    {
        return $this->hasMany(Item::class, 'unidad_id');
    }
    public function precios()
    {
        return $this->hasMany(PrecioItems::class, 'unidad_id');
    }
}
