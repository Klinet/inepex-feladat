<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsBaseTest extends TestCase
{
    use RefreshDatabase;

    protected function log($data){
        fwrite(STDERR, print_r($data, TRUE));
    }

    public function test_extended_player_controller_index_via_3000_port()
    {
        //todo ez ne maradjon majd
        // ez ideiglenes id a model tesztelőbe
        // Győződj meg róla, hogy a szerver a 3000-es porton fut.
        $client = new Client();
        $url = 'http://127.0.0.1:3000' . config('api.req_uri');
        $response = $client->get($url);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
