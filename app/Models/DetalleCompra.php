<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleCompraFactory> */
    use HasFactory;
    protected $table = "detalle_compras";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'compra_id',
        'item_id',
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'created_at',
        'updated_at'
    ];
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
