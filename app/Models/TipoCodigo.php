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
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function codigos()
    {
        return $this->hasMany(CodigoItems::class, 'tipo_codigo_id');
    }
}
