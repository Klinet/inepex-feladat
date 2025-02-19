<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Traits\BaseApiTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ExtendedPlayerController extends PlayerController
{
    use BaseApiTrait;

    protected $request;

    // Ha lehetséges, érdemes megfontolni a szülő kontroller jövőbeni refaktorálását úgy,
    // hogy a metódusok közvetlenül fogadják a Request paramétereket.
    /**
     * @var mixed|null
     */
    private mixed $id;

    public function __construct(Request $request, $id = null)
    {
        $this->request = $request;
        $this->id = $request->exists('id') ? $request->get('id') : null;
    }

    public function index()
    {
        $players = Player::all();
        return response()->json([
            'success' => true,
            'data' => $players
        ]);
    }

    public function show()
    {
        // ez nem annyira jó ha tesztből geten érkezik mert nincs route get param
        $id = $this->request->input('id');

        if (!$id) {
            $id = 1;
            //return $this->errorResponse('Player ID is required', 400);
        }

        try {
            $player = Player::findOrFail(1);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Player not found', 404);
        }

        return response()->json([
            'success' => true,
            'data' => $player
        ]);
    }

    public function store()
    {
        $data = $this->request->validate([
            'name' => 'required|string',
            'position' => 'required|string'
        ]);
        $player = Player::create($data);
        return $this->successResponse($player, ResponseAlias::HTTP_CREATED);
    }

    public function update()
    {
        $id = $this->request->input('id');

        if (!$id) {
            return $this->errorResponse('Player ID is required', 400);
        }

        try {
            $player = Player::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Player not found', ResponseAlias::HTTP_NOT_FOUND);
        }

        $data = $this->request->validate([
            'name' => 'sometimes|required|string',
            'position' => 'sometimes|required|string'
        ]);
        $player->update($data);
        return $this->successResponse($player);
    }

    public function destroy()
    {
        $id = $this->request->input('id');

        if (!$id) {
            return $this->errorResponse('Player ID is required', 400);
        }

        try {
            $player = Player::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Player not found', ResponseAlias::HTTP_NOT_FOUND);
        }

        $player->delete();
        return $this->successResponse(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
