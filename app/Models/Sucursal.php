<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    /** @use HasFactory<\Database\Factories\SucursalFactory> */
    use HasFactory;
    protected $table = "sucursals";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'empresa_id',
        'empleado_id',
        'es_matriz',
        'estado',
        'created_at',
        'updated_at'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function almacenes()
    {
        return $this->hasMany(Almacen::class, 'sucursal_id');
    }
}
