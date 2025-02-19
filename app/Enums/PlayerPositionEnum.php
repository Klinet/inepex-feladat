<?php

namespace App\Enums;

enum PlayerPositionEnum: string
{
    case DEFENDER = 'defender';
    case MIDFIELDER = 'midfielder';
    case FORWARD = 'forward';

    public static function values(): array
    {
        return [
            self::DEFENDER->value,
            self::MIDFIELDER->value,
            self::FORWARD->value,
        ];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
