<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\PlayerService;
use App\Http\Requests\PlayerRequest;

class PlayerController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new PlayerService();
        $this->middleware('players_exceed', ['only' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        return $this->service->createPlayer($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return $this->service->getOne($player->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, Player $player)
    {
        return $this->service->updatePlayer($request, $player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        return response()->json($this->service->deletePlayer($player));
    }

    /**
     * Refresh code the specified resource.
     */
    public function refreshCode(Player $player)
    {
        return $this->service->refreshCode($player);
    }
}
