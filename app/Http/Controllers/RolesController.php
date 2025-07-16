<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Roles;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RolesController extends Controller
{
    use CrudController;
    public Roles $model;
    public $rutaVisita = 'Roles';
    public function __construct()
    {
        $this->model = new Roles();
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
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        $permiso = strtolower($this->rutaVisita);
        if (!Auth::user()->can($permiso.'-edit')) {
            abort(403);
        }
        return Inertia::render($this->rutaVisita . '/CreateUpdate', array_merge([
            'isCreate' => false,
            'model' => $roles,
        ], PermissionService::getPermissions($permiso)));
    }

    /**
     * Get all permissions
     */
    public function getAllPermissions()
    {
        try {
            $permissions = Permissions::all();
            return ResponseService::success('Permisos obtenidos correctamente', $permissions);
        } catch (\Exception $e) {
            return ResponseService::error('Error al obtener los permisos', $e->getMessage());
        }
    }

    /**
     * Get permissions for a specific role
     */
    public function getRolePermissions(Roles $role)
    {
        try {
            $rolePermissions = $role->permissions()->pluck('id')->toArray();
            return ResponseService::success('Permisos del rol obtenidos correctamente', $rolePermissions);
        } catch (\Exception $e) {
            return ResponseService::error('Error al obtener los permisos del rol', $e->getMessage());
        }
    }

    /**
     * Assign permissions to a role
     */
    public function assignPermissions(Request $request, Roles $role)
    {
        try {
            $permissions = $request->input('permissions', []);
            $role->permissions()->sync($permissions);
            return ResponseService::success('Permisos asignados correctamente', $role->permissions);
        } catch (\Exception $e) {
            return ResponseService::error('Error al asignar los permisos', $e->getMessage());
        }
    }
}
