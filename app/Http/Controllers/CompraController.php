<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Compra/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Compra/CreateUpdate', [
            'isEditing' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        try {
            DB::beginTransaction();

            $compra = Compra::create($request->validated());

            // Crear detalles de compra
            if ($request->has('detalles') && is_array($request->detalles)) {
                foreach ($request->detalles as $detalle) {
                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'item_id' => $detalle['item_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                        'total' => $detalle['total']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Compra creada exitosamente',
                'data' => $compra
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al crear la compra: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        $compra->load([
            'proveedor',
            'empleado',
            'moneda',
            'tipoPago',
            'tipoCambio',
            'detalles.item'
        ]);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Compra encontrada',
            'data' => $compra
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        return Inertia::render('Compra/CreateUpdate', [
            'isEditing' => true,
            'compra' => $compra->load([
                'proveedor',
                'empleado',
                'moneda',
                'tipoPago',
                'tipoCambio',
                'detalles.item'
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        try {
            DB::beginTransaction();

            $compra->update($request->validated());

            // Actualizar detalles de compra
            if ($request->has('detalles') && is_array($request->detalles)) {
                // Eliminar detalles existentes
                $compra->detalles()->delete();

                // Crear nuevos detalles
                foreach ($request->detalles as $detalle) {
                    DetalleCompra::create([
                        'compra_id' => $compra->id,
                        'item_id' => $detalle['item_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                        'total' => $detalle['total']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Compra actualizada exitosamente',
                'data' => $compra
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al actualizar la compra: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        try {
            DB::beginTransaction();

            // Eliminar detalles de compra
            $compra->detalles()->delete();

            // Eliminar compra
            $compra->delete();

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Compra eliminada exitosamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al eliminar la compra: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Query compras with pagination and search.
     */
    public function query(Request $request)
    {
        $query = Compra::with(['proveedor', 'empleado', 'tipoPago', 'moneda']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('observaciones', 'like', "%{$search}%")
                  ->orWhereHas('proveedor', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
            });
        }

        $perPage = $request->has('per_page') ? (int) $request->per_page : 10;
        $compras = $query->orderBy('fecha', 'desc')->paginate($perPage);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Compras encontradas',
            'data' => $compras
        ]);
    }
}
