<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleVentaFactory> */
    use HasFactory;
    protected $table = "detalle_ventas";
    protected $primaryKey = "id";
    protected $fillable = [
        'venta_id',
        'item_id',
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'created_at',
        'updated_at'
    ];
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
