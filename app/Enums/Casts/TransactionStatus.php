<?php

namespace App\Enums\Casts;

use Filament\Support\Contracts\HasLabel;

enum TransactionStatus: string implements HasLabel
{
    case PENDING = 'pending';
    case DEBITED = 'debited';
    case CREDITED = 'credited';

    public static function toArray(): array
    {
        $values = [];
        foreach (self::cases() as $value) {
            $values[$value->value] = $value->name;
        }

        return $values;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::DEBITED => 'Debited',
            self::CREDITED => 'Credited',
        };
    }
}
