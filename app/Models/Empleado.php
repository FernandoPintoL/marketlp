<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\EmpleadoFactory> */
    use HasFactory;
    protected $table = "empleados";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'num_id',
        'direccion',
        'telefono',
        'email',
        'empresa_id',
        'tipo_documento_id',
        'empleado_cargo_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
    public function empleadoCargo()
    {
        return $this->belongsTo(EmpleadoCargo::class, 'empleado_cargo_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function almacenes()
    {
        return $this->belongsToMany(Almacen::class, 'empleado_almacen', 'empleado_id', 'almacen_id');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'empleado_id', 'id');
    }
    public function compras()
    {
        return $this->hasMany(Compra::class, 'empleado_id', 'id');
    }
}
