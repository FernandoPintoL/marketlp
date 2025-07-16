<?php

namespace App\Traits;

use App\Services\PermissionService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

trait CrudController
{
    protected function getModelName()
    {
        if (!isset($this->rutaVisita)) {
            throw new \Exception('La propiedad $rutaVisita no está definida en el controlador');
        }
        return $this->rutaVisita;
    }
    public function index()
    {
        return Inertia::render($this->getModelName() . '/Index', array_merge([
            'listado' => $this->model::all(),
        ], PermissionService::getPermissions($this->getModelName())));
    }
    public function create()
    {
        $permiso = strtolower($this->getModelName());
        if (!Auth::user()->can($permiso.'-create')) {
            abort(403);
        }

        return Inertia::render($this->getModelName() . '/CreateUpdate', array_merge([
            'isCreate' => true
        ], PermissionService::getPermissions($permiso)));
    }
    public function store(Request $request)
    {
        try {
            $data = $this->handleRequest($request);
            $model = $this->model::create($data);
            return ResponseService::success('Registro guardado correctamente', $model);
        } catch (\Exception $e) {
            return ResponseService::error('Error al guardar el registro', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $permiso = strtolower($this->getModelName());
        if (!Auth::user()->can($permiso.'-edit')) {
            abort(403);
        }

        $model = $this->model::findOrFail($id);

        return Inertia::render($this->getModelName() . '/CreateUpdate', array_merge([
            'isCreate' => false,
            'model' => $model,
        ], PermissionService::getPermissions($permiso)));
    }
    public function update(Request $request, $id)
    {
        try {
            $model = $this->model::findOrFail($id);
            $data = $this->handleRequest($request);
            $model->update($data);
            return ResponseService::success('Registro actualizado correctamente', $model);
        } catch (\Exception $e) {
            return ResponseService::error('Error al actualizar el registro', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $model = $this->model::findOrFail($id);
            $model->delete();
            return ResponseService::success('Registro eliminado correctamente');
        } catch (\Exception $e) {
            return ResponseService::error('Error al eliminar el registro', $e->getMessage());
        }
    }

    protected function handleRequest(Request $request)
    {
        // Método que puede ser sobrescrito para manejar lógica específica
        return $request->all();
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
            $is_query_table = $request->get('is_query_table', false);

            // 2. Verificar que existe el modelo
            if (!isset($this->model)) {
                throw new \Exception('Modelo no definido en el controlador');
            }

            // 3. Obtener y validar atributos del modelo de manera más eficiente
            $modelAttributes = array_merge(
                $this->model->getFillable(),
                ['id', 'created_at', 'updated_at']
            );

            // 4. Validar atributos de búsqueda
            $invalidAttributes = array_diff($attributes, $modelAttributes);
            if (!empty($invalidAttributes)) {
                return ResponseService::error(
                    'Atributo(s) de búsqueda no encontrado(s): ' . implode(', ', $invalidAttributes),
                    '',
                    400
                );
            }

            $query = $this->model::query();
            foreach ($attributes as $index => $attribute) {
                $method = $index === 0 ? 'where' : 'orWhere';

                if (in_array($attribute, ['created_at', 'updated_at'])) {
                    if ($dateStart && $dateEnd) {
                        $query->whereBetween($attribute, [
                            "$dateStart 00:00:00",
                            "$dateEnd 23:59:59"
                        ]);
                    }
                } elseif ($queryStr) {
                    $query->$method($attribute, 'LIKE', "%$queryStr%");
                }
            }
            // 6. Ejecutar la consulta según el tipo
            $response = $is_query_table
                ? $query->orderBy('id')->paginate($perPage, ['*'], 'page', $page)
                : $query->orderBy('id')->get();

            $cantidad = $is_query_table ? $response->total() : $response->count();
            // 7. Retornar respuesta
            return ResponseService::success(
                "$cantidad datos encontrados con $queryStr",
                $response
            );
        } catch (\Exception $e) {
            return ResponseService::error($e->getMessage(), '', $e->getCode());
        }
    }

}
