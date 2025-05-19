<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\TipoDocumento;
use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProveedorController extends Controller
{
    public Proveedor $model;
    public $rutaVisita = 'Proveedor';
    public function __construct()
    {
        $this->model = new Proveedor();
        /*$this->middleware('permission:almacen-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:almacen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:almacen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:almacen-delete', ['only' => ['destroy']]);*/
    }

    public function query(Request $request)
    {
        try {
            $queryStr = $request->get('query', '');
            $perPage = $request->get('perPage', 10);
            $page = $request->get('page', 1);
            $attributes = $request->get('attributes', ['id']); // Atributos por defecto
            $dateStart = $request->get('dateStart', '');
            $dateEnd = $request->get('dateEnd', '');

            // Obtener los atributos del modelo
            $modelAttributes = $this->model->getFillable();

            // Validar que los atributos estén en la lista de atributos permitidos
            foreach ($attributes as $attribute) {
                if (!in_array($attribute, $modelAttributes)) {
                    return ResponseService::error('Atributo no permitido: ' . $attribute, '', 400);
                }
            }

            // Construir la consulta dinámica
            $query = $this->model::query();
            $first = true;
            // Filtrar por fechas solo created_at esta en el array de atributos
            if (in_array('created_at', $attributes)) {
                $query->whereBetween('created_at', [$dateStart, $dateEnd]);
            }
            if (in_array('updated_at', $attributes)) {
                $query->whereBetween('updated_at', [$dateStart, $dateEnd]);
            }
            foreach ($attributes as $attribute) {
                if ($first) {
                    if (!in_array($attribute, ['created_at', 'updated_at'])) {
                        $query->where($attribute, 'LIKE', '%' . $queryStr . '%');
                    }
                    $first = false;
                } else {
                    if (!in_array($attribute, ['created_at', 'updated_at'])) {
                        $query->orWhere($attribute, 'LIKE', '%' . $queryStr . '%');
                    }
                }
            }
            $response = $query->orderBy('id', 'ASC')
                ->paginate($perPage, ['*'], 'page', $page);
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
            'isCreate' => true,
            'tipoDocumentos' => TipoDocumento::all(),
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
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
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        $permiso = strtolower($this->rutaVisita);
        if (!Auth::user()->can($permiso.'-edit')) {
            abort(403);
        }
        return Inertia::render($this->rutaVisita . '/CreateUpdate', array_merge([
            'isCreate' => false,
            'model' => $proveedor,
            'tipoDocumentos' => TipoDocumento::all(),
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        try {
            $proveedor->update($request->all());
            return ResponseService::success('Registro actualizado correctamente', $proveedor);
        } catch (\Exception $e) {
            return ResponseService::error('Error al actualizar el registro', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        try {
            $proveedor->delete();
            return ResponseService::success('Registro eliminado correctamente');
        } catch (\Exception $e) {
            return ResponseService::error('Error al eliminar el registro', $e->getMessage());
        }
    }
}
