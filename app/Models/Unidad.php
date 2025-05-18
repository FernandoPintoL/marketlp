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
    protected $fillable = [
        'id',
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
