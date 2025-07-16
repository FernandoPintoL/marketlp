<?php

namespace App\Services;
use App\Interfaz\CategorizacionInterface;
use Illuminate\Database\Eloquent\Model;

class CategorizacionService
{
    public function crear(Model $model, array $datos): CategorizacionInterface
    {
        return $model->create([
            'sigla' => $datos['sigla'],
            'detalle' => $datos['detalle']
        ]);
    }

    public function actualizar(Model $model, array $datos): bool
    {
        return $model->update([
            'sigla' => $datos['sigla'],
            'detalle' => $datos['detalle']
        ]);
    }
    /*public function buscarPorSigla(string $modelClass, string $sigla)
    {
        return $modelClass::bySigla($sigla)->first();
    }*/
}
