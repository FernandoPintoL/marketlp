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
    protected $fillable = [
        'name',
        'num_id',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'tipo_documento_id',
        'created_at',
        'updated_at'
    ];
}
