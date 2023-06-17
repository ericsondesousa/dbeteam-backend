<?php

namespace App\Services;

use App\Helper\PlayerHelper;
use App\Http\Requests\PlayerRequest;
use App\Models\Player;

class PlayerService
{
    public function getAll()
    {
        return Player::all()->makeHidden('code')->makeVisible('event_id');
    }

    public function getOne(int $id)
    {
        return Player::with('event')->find($id);
    }

    public function createPlayer(PlayerRequest $request)
    {
        return Player::create($request->validated());
    }

    public function updatePlayer(PlayerRequest $request, Player $player)
    {
        $player->fill($request->validated());
        $player->save();
        return $player;
    }

    public function deletePlayer(Player $player)
    {
        return $player->delete();
    }

    public function refreshCode(Player $player)
    {
        $player->fill([
            'code' => $this->generateCode($player->event_id)
        ]);
        $player->save();
        return $player;
    }

    public function generateCode(int $eventId, int $qtyChars = 3): string
    {
        $loop = true;

        while ($loop) {
            $code = PlayerHelper::generateCode($qtyChars);
            $loop = Player::whereCodeAndEventId($code, $eventId)->exists();
        }

        return $code;
    }
}
