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
    public $timestamps = true;
    protected $fillable = [
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
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
