<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Player;
use App\Models\PlayerConfirmation;
use App\Http\Requests\EventRequest;

class EventService
{
    public function getAll()
    {
        return Event::all();
    }

    public function getOne(int $id)
    {
        return Event::find($id);
    }

    public function createEvent(EventRequest $request)
    {
        return Event::create($request->validated());
    }

    public function updateEvent(EventRequest $request, Event $event)
    {
        $event->fill($request->validated());
        $event->save();
        return $event;
    }

    public function deleteEvent(Event $event)
    {
        return $event->delete();
    }

    public function getEventToPublic(Event $event)
    {
        $allConfirmed = PlayerConfirmation::all()->pluck('confirmed_at', 'player_id')->toArray();
        $players = Player::all()->makeHidden(['created_at', 'tenant_id', 'code']);
        foreach ($players as $player) {
            $player->confirmed_at = $allConfirmed[$player->id] ?? null;
        }
        $event['players'] = $players;

        return $event;
    }
}
