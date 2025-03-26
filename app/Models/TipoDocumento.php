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
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
