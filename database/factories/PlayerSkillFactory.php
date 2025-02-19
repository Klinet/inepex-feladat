<?php

namespace Database\Factories;

use App\Enums\PlayerSkillEnum;
use App\Models\Player;
use App\Models\PlayerSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerSkillFactory extends Factory
{
    protected $model = PlayerSkill::class;

    public function definition()
    {
        return [
            'player_id' => Player::factory(),
            'skill' => $this->faker->randomElement(PlayerSkillEnum::values()),
            'value' => $this->faker->numberBetween(1, 100),
        ];
    }
}
