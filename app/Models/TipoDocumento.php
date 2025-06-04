<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    /** @use HasFactory<\Database\Factories\TipoDocumentoFactory> */
    use HasFactory;
    protected $table = "tipo_documentos";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'tipo_documento_id');
    }
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_documento_id');
    }
    public function usuarios()
    {
        return $this->hasMany(User::class, 'tipo_documento_id');
    }
}
