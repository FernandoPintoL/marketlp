<?php

namespace App\Traits;

trait Categorizacion
{
    public function scopeBySigla($query, string $sigla)
    {
        return $query->where('sigla', $sigla);
    }
    public function scopeByDetalle($query, string $detalle)
    {
        return $query->where('detalle', 'LIKE', "%{$detalle}%");
    }
}
