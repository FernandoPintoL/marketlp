<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    public Categoria $model;
    public $rutaVisita = 'Categoria';
    public function __construct()
    {
        $this->model = new Categoria();
    }

    public function query(Request $request)
    {
        try {
            $queryStr = $request->get('query');
            $perPage = $request->get('perPage', 5);
            $page = $request->get('page', 1);
            $attributes = $request->get('attributes', ['id']); // Atributos por defecto
            $dateStart = $request->get('dateStart', '');
            $dateEnd = $request->get('dateEnd', '');

            // Obtener los atributos del modelo
            $modelAttributes = $this->model->getFillable();

            // Validar que los atributos estén en la lista de atributos permitidos
            foreach ($attributes as $attribute) {
                if (!in_array($attribute, $modelAttributes)) {
                    return ResponseService::error('Atributo de busqueda no encontrado: ' . $attribute, 'Atributo de busqueda no encontrado: ' . $attribute, 400);
                }
            }

            $query = $this->model::query();
            $first = true;
            foreach ($attributes as $attribute) {
                if ($first) {
                    if (!in_array($attribute, ['created_at', 'updated_at'])) {
                        if ($queryStr != '') {
                            $query->where($attribute, 'LIKE', '%' . $queryStr . '%');
                        }
                    }else {
                        if ($dateStart != '' && $dateEnd != '') {
                            if (!strtotime($dateStart) || !strtotime($dateEnd)) {
                                return ResponseService::error('Fecha de inicio o fin no válida', 'Fecha de inicio o fin no válida', 400);
                            }
                            $query->whereBetween($attribute, [$dateStart . " 00:00:00", $dateEnd . " 23:59:59"]);
                        }
                    }
                    $first = false;
                } else {
                    if (!in_array($attribute, ['created_at', 'updated_at'])) {
                        if ($queryStr != '') {
                            $query->orWhere($attribute, 'LIKE', '%' . $queryStr . '%');
                        }
                    }else {
                        if ($dateStart != '' && $dateEnd != '') {
                            if (!strtotime($dateStart) || !strtotime($dateEnd)) {
                                return ResponseService::error('Fecha de inicio o fin no válida', 'Fecha de inicio o fin no válida', 400);
                            }
                            $query->whereBetween($attribute, [$dateStart . " 00:00:00", $dateEnd . " 23:59:59"]);
                        }
                    }
                }
            }
            $response = $query->orderBy('id', 'ASC')->paginate($perPage, ['*'], 'page', $page);
            $cantidad = count($response);
            $str = strval($cantidad);
            return ResponseService::success("$str datos encontrados con $queryStr", $response);
        } catch (\Exception $e) {
            return ResponseService::error($e->getMessage(), '', $e->getCode());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render($this->rutaVisita . '/Index', array_merge([
            'listado' => $this->model::all(),
        ], PermissionService::getPermissions($this->rutaVisita)));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permiso = strtolower($this->rutaVisita);
        if (!Auth::user()->can($permiso.'-create')) {
            abort(403);
        }
        return Inertia::render($this->rutaVisita . '/CreateUpdate', array_merge([
            'isCreate' => true
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            $data = $this->model::create($request->all());
            return ResponseService::success('Registro guardado correctamente', $data);
        } catch (\Exception $e) {
            return ResponseService::error('Error al guardar el registro', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categorium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categorium)
    {
        $permiso = strtolower($this->rutaVisita);
        if (!Auth::user()->can($permiso.'-edit')) {
            abort(403);
        }
        return Inertia::render($this->rutaVisita . '/CreateUpdate', array_merge([
            'isCreate' => false,
            'model' => $categorium,
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categorium)
    {
        try {
            $categorium->update($request->all());
            return ResponseService::success('Registro actualizado correctamente', $categorium);
        } catch (\Exception $e) {
            return ResponseService::error('Error al actualizar el registro', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categorium)
    {
        try {
            $categorium->delete();
            return ResponseService::success('Registro eliminado correctamente');
        } catch (\Exception $e) {
            return ResponseService::error('Error al eliminar el registro', $e->getMessage());
        }
    }
}
