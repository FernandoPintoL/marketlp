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
    public $timestamps = true;
    protected $fillable = [
        'almacen_id',
        'codigo',
        'name',
        'descripcion',
        'maximo',
        'minimo',
    ];
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
}
