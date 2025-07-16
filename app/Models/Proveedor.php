<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /** @use HasFactory<\Database\Factories\ProveedorFactory> */
    use HasFactory;
    protected $table = "proveedors";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'num_id',
        'direccion',
        'telefono',
        'contacto',
        'tipo_documento_id',
        'empresa_id'
    ];
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedor_id');
    }
}
