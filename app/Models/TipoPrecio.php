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
    protected $fillable = [
        'id',
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
