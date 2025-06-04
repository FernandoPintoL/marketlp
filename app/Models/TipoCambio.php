<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
    /** @use HasFactory<\Database\Factories\TipoCambioFactory> */
    use HasFactory;
    protected $table = "tipo_cambios";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'moneda_origen_id',
        'moneda_destino_id',
        'fecha',
        'tasa_cambio',
        'tasa_inversa',
        'fuente',
        'created_at',
        'updated_at'
    ];
    public function monedaOrigen()
    {
        return $this->belongsTo(Moneda::class, 'moneda_origen_id');
    }
    public function monedaDestino()
    {
        return $this->belongsTo(Moneda::class, 'moneda_destino_id');
    }
}
