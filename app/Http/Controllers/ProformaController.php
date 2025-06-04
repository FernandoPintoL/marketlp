<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use App\Models\DetalleProforma;
use App\Http\Requests\StoreProformaRequest;
use App\Http\Requests\UpdateProformaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Proforma/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Proforma/CreateUpdate', [
            'isEditing' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProformaRequest $request)
    {
        try {
            DB::beginTransaction();

            $proforma = Proforma::create($request->validated());

            // Crear detalles de proforma
            if ($request->has('detalles') && is_array($request->detalles)) {
                foreach ($request->detalles as $detalle) {
                    DetalleProforma::create([
                        'proforma_id' => $proforma->id,
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
                'message' => 'Proforma creada exitosamente',
                'data' => $proforma
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al crear la proforma: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proforma $proforma)
    {
        $proforma->load([
            'cliente',
            'empleado',
            'moneda',
            'tipoProforma',
            'detalles.item'
        ]);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Proforma encontrada',
            'data' => $proforma
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proforma $proforma)
    {
        return Inertia::render('Proforma/CreateUpdate', [
            'isEditing' => true,
            'proforma' => $proforma->load([
                'cliente',
                'empleado',
                'moneda',
                'tipoProforma',
                'detalles.item'
            ])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProformaRequest $request, Proforma $proforma)
    {
        try {
            DB::beginTransaction();

            $proforma->update($request->validated());

            // Actualizar detalles de proforma
            if ($request->has('detalles') && is_array($request->detalles)) {
                // Eliminar detalles existentes
                $proforma->detalles()->delete();

                // Crear nuevos detalles
                foreach ($request->detalles as $detalle) {
                    DetalleProforma::create([
                        'proforma_id' => $proforma->id,
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
                'message' => 'Proforma actualizada exitosamente',
                'data' => $proforma
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al actualizar la proforma: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proforma $proforma)
    {
        try {
            DB::beginTransaction();

            // Eliminar detalles de proforma
            $proforma->detalles()->delete();

            // Eliminar proforma
            $proforma->delete();

            DB::commit();

            return response()->json([
                'isSuccess' => true,
                'message' => 'Proforma eliminada exitosamente',
                'data' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'isSuccess' => false,
                'message' => 'Error al eliminar la proforma: ' . $e->getMessage(),
                'data' => null
            ]);
        }
    }

    /**
     * Query proformas with pagination and search.
     */
    public function query(Request $request)
    {
        $query = Proforma::with(['cliente', 'empleado', 'moneda', 'tipoProforma']);

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
        $proformas = $query->orderBy('fecha', 'desc')->paginate($perPage);

        return response()->json([
            'isSuccess' => true,
            'message' => 'Proformas encontradas',
            'data' => $proformas
        ]);
    }

    /**
     * Convert proforma to venta.
     */
    public function convertToVenta(Proforma $proforma)
    {
        // This method would create a new Venta based on the Proforma
        // Implementation would depend on business rules

        return response()->json([
            'isSuccess' => true,
            'message' => 'Proforma convertida a venta exitosamente',
            'data' => null
        ]);
    }
}
