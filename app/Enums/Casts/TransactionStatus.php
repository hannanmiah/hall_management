<?php

namespace App\Enums\Casts;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case DEBITED = 'debited';
    case CREDITED = 'credited';

    public static function toArray(): array
    {
        $values = [];

        foreach (self::getValues() as $value) {
            $values[$value] = $value;
        }

        return $values;
    }

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::DEBITED,
            self::CREDITED,
        ];
    }

}
