<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbicacionItem extends Model
{
    /** @use HasFactory<\Database\Factories\UbicacionItemFactory> */
    use HasFactory;
    protected $table = "ubicacion_items";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sector_id',
        'codigo',
        'capacidad',
        'estado',
        'tipo_ubicacion_items_id'
    ];
    public function tipoUbicacion()
    {
        return $this->belongsTo(TipoUbicacionItem::class, 'tipo_ubicacion_items_id');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'ubicacion_item_id');
    }
}
