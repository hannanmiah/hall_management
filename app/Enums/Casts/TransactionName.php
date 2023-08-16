<?php

namespace App\Enums\Casts;

use Filament\Support\Contracts\HasLabel;

enum TransactionName: string implements HasLabel
{
    case FEE = 'fee';
    case EXPENSE = 'expense';
    case DONATION = 'donation';
    case OTHER = 'other';

    public static function toArray(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[$case->value] = $case->name;
        }

        return $values;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FEE => 'Fee',
            self::EXPENSE => 'Expense',
            self::DONATION => 'Donation',
            self::OTHER => 'Other',
        };
    }
}
