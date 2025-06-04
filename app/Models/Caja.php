<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    /** @use HasFactory<\Database\Factories\CajaFactory> */
    use HasFactory;
    protected $table = 'cajas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'nombre',
        'ubicacion',
        'impresora',
        'estado',
        'almacen_id',
        'empleado_id',
        'sucursal_id',
        'created_at',
        'updated_at',
    ];
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
    public function arqueos()
    {
        return $this->hasMany(ArqueoCaja::class, 'caja_id');
    }
    public function aperturas()
    {
        return $this->hasMany(AperturaCaja::class, 'caja_id');
    }
    public function movimientos()
    {
        return $this->hasMany(MovimientoCaja::class, 'caja_id');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'caja_id');
    }
}
