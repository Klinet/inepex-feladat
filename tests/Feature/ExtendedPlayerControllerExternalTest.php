<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Player;

class ExtendedPlayerControllerExternalTest extends TestCase
{
    protected string $url;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->singleton(\App\Http\Controllers\PlayerController::class, \App\Http\Controllers\ExtendedPlayerController::class);
        $this->url = env('APP_URL', 'http://127.0.0.1:3000') . config('api.req_uri', '/api/player/');
    }

    public function testIndexReturnsAllPlayers()
    {
        // Fetch the number of players in the database
        $playerCount = Player::count();
        $this->assertGreaterThan(0, $playerCount, 'No players found in the database.');

        // Call API
        $response = $this->getJson($this->url);

        // Assert response structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'position',
                        'created_at',
                        'updated_at',
                        'skills' => [
                            '*' => [
                                'id',
                                'skill',
                                'value',
                                'player_id',
                            ]
                        ],
                    ]
                ]
            ])
            ->assertJsonFragment(['success' => true])
            ->assertJsonCount($playerCount, 'data'); // Ensure all players are returned
    }

    public function testShowReturnsPlayerWithIdOne()
    {
        // Ensure player with ID 1 exists
        $player = Player::find(1);
        $this->assertNotNull($player, 'Player with ID 1 does not exist.');

        $response = $this->getJson($this->url . '1');

        //dd($response);
        // Assert response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'position',
                    'created_at',
                    'updated_at',
                    'skills' => [
                        '*' => [
                            'id',
                            'skill',
                            'value',
                            'player_id',
                        ]
                    ],
                ]
            ])
            ->assertJsonFragment(['id' => 1]); // Ensure correct player is returned
    }
}
