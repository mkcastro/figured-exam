<?php

namespace App\Http\Controllers;

use App\Exceptions\LessThanZeroQuantityException;
use App\Http\Requests\StoreInventoryMovementRequest;
use App\Http\Requests\UpdateInventoryMovementRequest;
use App\Imports\InventoryMovementImport;
use App\Models\InventoryMovement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InventoryMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('InventoryMovement/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventoryMovementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryMovementRequest $request): JsonResponse
    {
        $file = $request->file('inventory_movements_file');

        $excel = new InventoryMovementImport;

        try {
            DB::transaction(function () use ($excel, $file) {
                $excel->import($file);
            });
        } catch (LessThanZeroQuantityException $e) {
            return response()->json([
                'errors' => [
                    'inventory_movements_file' => [
                        'The quantity results to less than 0.',
                    ],
                ],
            ], 422);
        }

        return response()->json([
            'message' => 'Successfully imported inventory movements.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovements
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryMovement $inventoryMovements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovements
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryMovement $inventoryMovements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryMovementRequest  $request
     * @param  \App\Models\InventoryMovement  $inventoryMovements
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryMovementRequest $request, InventoryMovement $inventoryMovements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventoryMovement  $inventoryMovements
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryMovement $inventoryMovements)
    {
        //
    }
}
