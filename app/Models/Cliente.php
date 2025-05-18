<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;
    protected $table = "clientes";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'name',
        'num_id',
        'tipo_documento_id',
        'direccion',
        'telefono',
        'email',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
