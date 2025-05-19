<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioItems extends Model
{
    /** @use HasFactory<\Database\Factories\PrecioItemsFactory> */
    use HasFactory;
    protected $table = "precio_items";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'item_id',
        'tipo_precio_id',
        'precio',
        'created_at',
        'updated_at'
    ];
}
