<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Player;
use App\Models\PlayerSkill;
use App\Enums\PlayerPositionEnum;
use App\Enums\PlayerSkillEnum;

class ModelsTest extends ModelsBaseTest
{
    public function test_player_creation_without_skills()
    {
        $player = Player::factory()->create();

        $this->assertDatabaseHas('players', [
            'id' => $player->id,
            'name' => $player->name,
        ]);

        $this->assertInstanceOf(Collection::class, $player->skills);
        $this->assertCount(0, $player->skills);
        $this->assertInstanceOf(PlayerPositionEnum::class, $player->position);
    }

    public function test_player_creation_with_skills()
    {
        $player = Player::factory()
            ->has(PlayerSkill::factory()->count(3), 'skills')
            ->create();

        $this->assertDatabaseHas('players', [
            'id' => $player->id,
            'name' => $player->name,
        ]);

        $this->assertInstanceOf(Collection::class, $player->skills);
        $this->assertCount(3, $player->skills);
        $this->assertInstanceOf(PlayerPositionEnum::class, $player->position);

        foreach ($player->skills as $skill) {
            $this->assertDatabaseHas('player_skills', [
                'id' => $skill->id,
                'player_id' => $player->id,
                'value' => $skill->value,
            ]);
            $this->assertInstanceOf(PlayerSkillEnum::class, $skill->skill);
        }
    }

    public function test_player_skill_belongs_to_player()
    {
        $skill = PlayerSkill::factory()->create();
        $this->assertNotNull($skill->player);
        $this->assertInstanceOf(Player::class, $skill->player);
        $this->assertInstanceOf(PlayerPositionEnum::class, $skill->player->position);
    }
}
