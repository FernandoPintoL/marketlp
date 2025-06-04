<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProforma extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleProformaFactory> */
    use HasFactory;
    protected $table = "detalle_proformas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'proforma_id',
        'item_id',
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'created_at',
        'updated_at'
    ];
    public function proforma()
    {
        return $this->belongsTo(Proforma::class, 'proforma_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
