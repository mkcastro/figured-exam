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
            'transacted_at' => DateTime::createFromFormat('d/m/Y', $row['date'])->format('Y-m-d'),
            'type' => InventoryMovementType::from($row['type'])->initial(),
            'quantity' => $row['quantity'],
            'price' => $row['unit_price'],
        ]);
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date_format:d/m/Y',
            ],
            'type' => [
                'required',
                'string',
                new Enum(InventoryMovementType::class),

            ],
            'quantity' => [
                'required',
                'integer',
                'gt:0',
            ],
            'unit_price' => [
                'nullable',
                'numeric',
                'gt:0',
            ],
        ];
    }
}
