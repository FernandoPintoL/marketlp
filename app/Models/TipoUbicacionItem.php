<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUbicacionItem extends Model
{
    /** @use HasFactory<\Database\Factories\TipoUbicacionItemFactory> */
    use HasFactory;
    protected $table = "tipo_ubicacion_items";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function ubicaciones()
    {
        return $this->hasMany(UbicacionItem::class, 'tipo_ubicacion_id');
    }
}
