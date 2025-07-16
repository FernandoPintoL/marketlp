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
        'name',
        'estado',
        'empleado_id',
        'sucursal_id'
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
