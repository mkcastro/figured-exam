<?php

namespace App\Enums;

enum InventoryMovementType: string
{
    case Purchase = 'Purchase';
    case Application = 'Application';

    public function initial(): string
    {
        return match ($this) {
            static::Purchase => 'p',
            static::Application => 'a',
        };
    }
}
