<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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



// Public routes
Route::get('/', function () {
    // Get featured products to display on the welcome page
    $items = \App\Models\Item::with(['categoria', 'precioItems' => function($query) {
        $query->where('tipo_precio_id', 1); // Assuming 1 is the default price type
    }])->take(12)->get();

    return Inertia::render('Welcome', [
        'items' => $items
    ]);
})->name('home');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
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
        'users' => UserController::class,
    ];
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Resource routes
    foreach ($resources as $key => $controller) {
        Route::resource("/$key", $controller);
        Route::post("/$key/query", [$controller, 'query'])->name("$key.query");
    }

    // Additional routes for Venta, Compra, and Proforma
    Route::resource('/venta', \App\Http\Controllers\VentaController::class);
    Route::post('/venta/query', [\App\Http\Controllers\VentaController::class, 'query'])->name('venta.query');

    Route::resource('/compra', \App\Http\Controllers\CompraController::class);
    Route::post('/compra/query', [\App\Http\Controllers\CompraController::class, 'query'])->name('compra.query');

    Route::resource('/proforma', \App\Http\Controllers\ProformaController::class);
    Route::post('/proforma/query', [\App\Http\Controllers\ProformaController::class, 'query'])->name('proforma.query');
    Route::post('/proforma/{proforma}/convert-to-venta', [\App\Http\Controllers\ProformaController::class, 'convertToVenta'])->name('proforma.convert-to-venta');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
