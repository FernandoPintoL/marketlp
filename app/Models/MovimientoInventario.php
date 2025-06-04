<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    /** @use HasFactory<\Database\Factories\MovimientoInventarioFactory> */
    use HasFactory;
    protected $table = "movimiento_inventarios";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'item_id',
        'almacen_origen_id',
        'almacen_destino_id',
        'ubicacion_origen_item_id',
        'ubicacion_destino_item_id',
        'tipo_movimiento_id',
        'cantidad',
        'fecha_movimiento',
        'referencia_id',
        'referencia_tipo',
        'costo_unitario',
        'lote',
        'fecha_vencimiento',
        'usuario_responsable',
        'observaciones',
        'created_at',
        'updated_at'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function almacenOrigen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_origen_id');
    }
    public function almacenDestino()
    {
        return $this->belongsTo(Almacen::class, 'almacen_destino_id');
    }
    public function ubicacionOrigenItem()
    {
        return $this->belongsTo(UbicacionItem::class, 'ubicacion_origen_item_id');
    }
    public function ubicacionDestinoItem()
    {
        return $this->belongsTo(UbicacionItem::class, 'ubicacion_destino_item_id');
    }
    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento_id');
    }
    public function referencia()
    {
        if ($this->referencia_tipo === 'compra') {
            return $this->belongsTo(Compra::class, 'referencia_id');
        } elseif ($this->referencia_tipo === 'venta') {
            return $this->belongsTo(Venta::class, 'referencia_id');
        }
        return null;
    }
}
