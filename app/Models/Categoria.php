<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;
    protected $table = "categorias";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
