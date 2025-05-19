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
        'id',
        'codigo_id',
        'items_id',
        'codigo',
        'created_at',
        'updated_at'
    ];
}
