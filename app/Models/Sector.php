<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    /** @use HasFactory<\Database\Factories\SectorFactory> */
    use HasFactory;
    protected $table = "sectors";
    protected $primaryKey = "id";
    protected $fillable = [
        'sigla',
        'detalle',
        'maximo',
        'minimo',
        'created_at',
        'updated_at'
    ];
}
