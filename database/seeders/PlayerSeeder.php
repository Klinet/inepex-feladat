<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\PlayerSkill;
use App\Enums\PlayerSkillEnum;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Player::factory()
            ->count(10)
            ->create()
            ->each(function ($player) use ($faker) {
                PlayerSkill::factory()->count(3)->create([
                    'player_id' => $player->id,
                    'skill' => $faker->randomElement(PlayerSkillEnum::values()),
                    'value' => $faker->numberBetween(1, 100),
                ]);
            });
    }
}

