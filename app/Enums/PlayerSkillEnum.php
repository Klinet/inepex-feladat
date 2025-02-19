<?php

namespace App\Enums;

enum PlayerSkillEnum: string
{
    case DEFENSE = 'defense';
    case ATTACK = 'attack';
    case SPEED = 'speed';
    case STRENGTH = 'strength';
    case STAMINA = 'stamina';

    public static function values(): array
    {
        return [
            self::DEFENSE->value,
            self::ATTACK->value,
            self::SPEED->value,
            self::STRENGTH->value,
            self::STAMINA->value,
        ];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
