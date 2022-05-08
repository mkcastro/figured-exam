<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryMovementRequest;
use App\Http\Requests\UpdateInventoryMovementRequest;
use App\Imports\InventoryMovementImport;
use App\Models\InventoryMovement;
use Illuminate\Http\JsonResponse;
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
        $excel->import($file);

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
