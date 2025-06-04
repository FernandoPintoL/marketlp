<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMovimientoFactory> */
    use HasFactory;
    protected $table = "tipo_movimientos";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
}
