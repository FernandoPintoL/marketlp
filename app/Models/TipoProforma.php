<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProforma extends Model
{
    /** @use HasFactory<\Database\Factories\TipoProformaFactory> */
    use HasFactory;
    protected $table = "tipo_proformas";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
       'sigla',
        'detalle',
        'created_at',
        'updated_at'
    ];
    public function proformas()
    {
        return $this->hasMany(Proforma::class, 'tipo_proforma_id');
    }
}
