<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrecio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoPrecioFactory> */
    use HasFactory;
    protected $table = "tipo_precios";
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
        return $this->hasMany(Item::class, 'tipo_precio_id');
    }
    public function precios()
    {
        return $this->hasMany(PrecioItems::class, 'tipo_precio_id');
    }
}
