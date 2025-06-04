<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Venta/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Venta/CreateUpdate', [
            'isEditing' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request)
    {
        try {
            DB::beginTransaction();

            $venta = Venta::create($request->validated());

            // Crear detalles de venta
            if ($request->has('detalles') && is_array($request->detalles)) {
                foreach ($request->detalles as $detalle) {
                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'item_id' => $detalle['item_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                        'descuento' => $detalle['descuento'] ?? 0,
                        'total' => $detalle['total']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Venta creada exitosamente',
                'data' => $venta
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al crear la venta: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load([
            'cliente',
            'empleado',
            'tipoPago',
            'moneda',
            'proforma',
            'caja',
            'aperturaCaja',
            'detalles.item'
        ]);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Venta encontrada',
            'data' => $venta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        return Inertia::render('Venta/CreateUpdate', [
            'isEditing' => true,
            'venta' => $venta->load([
                'cliente',
                'empleado',
                'tipoPago',
                'moneda',
                'proforma',
                'caja',
                'aperturaCaja',
                'detalles.item'
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        try {
            DB::beginTransaction();

            $venta->update($request->validated());

            // Actualizar detalles de venta
            if ($request->has('detalles') && is_array($request->detalles)) {
                // Eliminar detalles existentes
                $venta->detalles()->delete();

                // Crear nuevos detalles
                foreach ($request->detalles as $detalle) {
                    DetalleVenta::create([
                        'venta_id' => $venta->id,
                        'item_id' => $detalle['item_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                        'descuento' => $detalle['descuento'] ?? 0,
                        'total' => $detalle['total']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Venta actualizada exitosamente',
                'data' => $venta
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al actualizar la venta: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        try {
            DB::beginTransaction();

            // Eliminar detalles de venta
            $venta->detalles()->delete();

            // Eliminar venta
            $venta->delete();

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Venta eliminada exitosamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al eliminar la venta: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Query ventas with pagination and search.
     */
    public function query(Request $request)
    {
        $query = Venta::with(['cliente', 'empleado', 'tipoPago', 'moneda']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('observaciones', 'like', "%{$search}%")
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
            });
        }

        $perPage = $request->has('per_page') ? (int) $request->per_page : 10;
        $ventas = $query->orderBy('fecha', 'desc')->paginate($perPage);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Ventas encontradas',
            'data' => $ventas
        ]);
    }
}
