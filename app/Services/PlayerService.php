<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Player;
use App\Helper\PlayerHelper;
use App\Models\PlayerConfirmation;
use App\Http\Requests\PlayerRequest;

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

    public function toggleConfirmation(Event $event, Player $player)
    {
        $isConfirmed = PlayerConfirmation::whereEventIdAndPlayerId($event->id, $player->id)->first();

        if ($isConfirmed) {
            $isConfirmed->delete();
            return response()->json(['deleted' => true], 200);
        } else {
            PlayerConfirmation::create([
                'tenant_id' => $event->tenant_id,
                'event_id' => $event->id,
                'player_id' => $player->id,
                'confirmed_at' => Carbon::now()
            ]);
            return response()->json(['created' => true], 201);
        }
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
