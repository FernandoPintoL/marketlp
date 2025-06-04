<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    /** @use HasFactory<\Database\Factories\ProformaFactory> */
    use HasFactory;
    protected $table = "proformas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'fecha',
        'fecha_validez',
        'total',
        'cambio',
        'descuento',
        'estado',
        'observaciones',
        'tasa_cambio',
        'total_moneda_origen',
        'moneda_id',
        'cliente_id',
        'empleado_id',
        'tipo_proforma_id',
        'created_at',
        'updated_at'
    ];
    public function moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
    public function tipoProforma()
    {
        return $this->belongsTo(TipoProforma::class, 'tipo_proforma_id');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleProforma::class, 'proforma_id');
    }
}
