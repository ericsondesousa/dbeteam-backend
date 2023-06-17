<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use App\Models\Event;

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
        return Event::find($event->id);
    }
}
