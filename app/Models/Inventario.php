<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    /** @use HasFactory<\Database\Factories\InventarioFactory> */
    use HasFactory;
    protected $table = "inventarios";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'item_id',
        'almacen_id',
        'ubicacion_item_id',
        'lote',
        'fecha_vencimiento',
        'cantidad_disponible',
        'cantidad_reservada',
        'cantidad_apartada',
        'fecha_ultima_actualizacion',
        'created_at',
        'updated_at'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    public function ubicacionItem()
    {
        return $this->belongsTo(UbicacionItem::class, 'ubicacion_item_id');
    }
}
