<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoItems extends Model
{
    /** @use HasFactory<\Database\Factories\CodigoItemsFactory> */
    use HasFactory;
    protected $table = "codigo_items";
    protected $primaryKey = "id";
    protected $fillable = [
        'item_id',
        'tipo_codigo_id',
        'codigo'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function tipoCodigo()
    {
        return $this->belongsTo(TipoCodigo::class, 'tipo_codigo_id');
    }
}
