<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /** @use HasFactory<\Database\Factories\EmpresaFactory> */
    use HasFactory;
    protected $table = "empresas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'num_id',
        'telefono',
        'direccion',
        'photo_path',
        'tipo_documento_id'
    ];
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

}
