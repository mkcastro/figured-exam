<?php

namespace App\Imports;

use App\Enums\InventoryMovementType;
use App\Models\InventoryMovement;
use DateTime;
use Illuminate\Validation\Rules\Enum;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InventoryMovementImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row): InventoryMovement
    {
        return new InventoryMovement([
            // ! explicitly set product id to 1 since incomming data has no product id
            'product_id' => 1,
            'transacted_at' => $row['date'],
            'type' => InventoryMovementType::from($row['type'])->initial(),
            'quantity' => abs($row['quantity']),
            'price' => $row['unit_price'],
        ]);
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
                'unique:inventory_movements,transacted_at',
            ],
            'type' => [
                'required',
                'string',
                new Enum(InventoryMovementType::class),
            ],
            'quantity' => [
                'required',
                'integer',
            ],
            'unit_price' => [
                'nullable',
                'numeric',
                'gt:0',
            ],
        ];
    }

    public function prepareForValidation($data, $index): array
    {
        $data['date'] = DateTime::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        return $data;
    }
}
