<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCodigo extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCodigoFactory> */
    use HasFactory;
    protected $table = "tipo_codigos";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
