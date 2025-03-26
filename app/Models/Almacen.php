<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    /** @use HasFactory<\Database\Factories\AlmacenFactory> */
    use HasFactory;
    protected $table = "almacens";
    protected $primaryKey = "id";
    protected $fillable = [
        'sigla',
        'detalle',
        'direccion',
        'created_at',
        'updated_at'
    ];
}
