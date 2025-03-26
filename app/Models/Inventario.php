<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    /** @use HasFactory<\Database\Factories\InventarioFactory> */
    use HasFactory;
    protected $table = "inventarios";
    protected $fillable = [
        'item_id',
        'almacen_id',
        'sector_id',
        'stock',
        'created_at',
        'updated_at'
    ];
}
