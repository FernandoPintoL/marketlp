<?php

namespace App\Http\Controllers;

use App\Models\Ajustes;
use App\Http\Requests\StoreAjustesRequest;
use App\Http\Requests\UpdateAjustesRequest;
use App\Models\Categoria;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AjustesController extends Controller
{
    public Ajustes $model;
    public $rutaVisita = 'Ajustes';
    public function __construct()
    {
        $this->model = new Ajustes();
        /*$this->middleware('permission:almacen-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:almacen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:almacen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:almacen-delete', ['only' => ['destroy']]);*/
    }
    public function query(Request $request)
    {
        try {
            $queryStr = $request->get('query');
            $perPage = $request->get('perPage', 10);
            $page = $request->get('page', 1);
            $responsse = $this->model::where('sigla', 'LIKE', '%' . $queryStr . '%')
                ->orWhere('detalle', 'LIKE', '%' . $queryStr . '%')
                ->orderBy('id', 'ASC')
                ->paginate($perPage, ['*'], 'page', $page);
            $cantidad = count($responsse);
            $str = strval($cantidad);
            return ResponseService::success("$str datos encontrados", $responsse);
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
    public function store(StoreAjustesRequest $request)
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
    public function show(Ajustes $ajustes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajustes $ajustes)
    {
        $permiso = strtolower($this->rutaVisita);
        if (!Auth::user()->can($permiso.'-edit')) {
            abort(403);
        }
        return Inertia::render($this->rutaVisita . '/CreateUpdate', array_merge([
            'isCreate' => false,
            'model' => $ajustes,
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAjustesRequest $request, Ajustes $ajustes)
    {
        try {
            $ajustes->update($request->all());
            return ResponseService::success('Registro actualizado correctamente', $ajustes);
        } catch (\Exception $e) {
            return ResponseService::error('Error al actualizar el registro', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajustes $ajustes)
    {
        try {
            $ajustes->delete();
            return ResponseService::success('Registro eliminado correctamente');
        } catch (\Exception $e) {
            return ResponseService::error('Error al eliminar el registro', $e->getMessage());
        }
    }
}
