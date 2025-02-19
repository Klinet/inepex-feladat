<?php

namespace Database\Factories;

use App\Enums\PlayerPositionEnum;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->randomElement(PlayerPositionEnum::values()),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
