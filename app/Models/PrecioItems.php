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
    public $timestamps = true;
    protected $fillable = [
        'item_id',
        'tipo_precio_id',
        'precio',
        'created_at',
        'updated_at'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function tipoPrecio()
    {
        return $this->belongsTo(TipoPrecio::class, 'tipo_precio_id');
    }
}
