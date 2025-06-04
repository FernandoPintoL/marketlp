<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $table = "items";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'cod_barra',
        'name',
        'descripcion',
        'photo_path',
        'categoria_id',
        'unidad_id',
        'created_at',
        'updated_at'
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }
}
