<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AjustesController,
    AlmacenController,
    CategoriaController,
    ClienteController,
    EmpleadoController,
    EmpleadoCargoController,
    EmpresaController,
    InventarioController,
    ItemController,
    MenuController,
    PermissionsController,
    ProveedorController,
    RolesController,
    SectorController,
    TipoDocumentoController,
    UnidadController,
    UserController
};


$resources = [
    'ajustes' => AjustesController::class,
    'almacen' => AlmacenController::class,
    'categoria' => CategoriaController::class,
    'cliente' => ClienteController::class,
    'empleado' => EmpleadoController::class,
    'empleado-cargo' => EmpleadoCargoController::class,
    'empresa' => EmpresaController::class,
    'inventario' => InventarioController::class,
    'item' => ItemController::class,
    'menu' => MenuController::class,
    'permissions' => PermissionsController::class,
    'proveedor' => ProveedorController::class,
    'roles' => RolesController::class,
    'sector' => SectorController::class,
    'tipo-documento' => TipoDocumentoController::class,
    'unidad' => UnidadController::class,
    'users' => UserController::class
];

// Resource routes
foreach ($resources as $key => $controller) {
    Route::post("/$key/query", [$controller, 'query'])->name("api.$key.query");
    Route::post("/$key/store", [$controller, 'store'])->name("api.$key.store");
    Route::put("/$key/{".$key."}", [$controller, 'update'])->name("api.$key.update");
}
