<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    /** @use HasFactory<\Database\Factories\MonedaFactory> */
    use HasFactory;
    protected $table = "monedas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'codigo',
        'nombre',
        'simbolo',
        'es_moneda_local',
        'estado',
        'created_at',
        'updated_at'
    ];
}
