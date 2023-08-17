<?php

namespace App\Enums\Casts;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TransactionName: string implements HasLabel, HasColor
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

    /**
     * @return string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FEE => 'success',
            self::EXPENSE => 'danger',
            self::DONATION => 'primary',
            self::OTHER => 'warning',
        };
    }
}
