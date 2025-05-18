<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $table = "items";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'cod_barra',
        'name',
        'descripcion',
        'categoria_id',
        'unidad_id',
        'created_at',
        'updated_at'
    ];
}
