<?php

namespace App\Actions;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreInventory
{
    use AsAction;

    public function rules(): array
    {
        return [
            'inventory' => 'required|file|mimes:csv',
        ];
    }

    public function handle()
    {
    }

    public function asController(ActionRequest $request)
    {
        return response()->json([
            'message' => 'Inventory updated successfully',
        ]);
    }
}
