<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new EventService();
        $this->middleware('events_exceed', ['only' => ['store']]);
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
    public function store(EventRequest $request)
    {
        return $this->service->createEvent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Display the specified resource by event token.
     */
    public function public(Event $event)
    {
        return $this->service->getEventToPublic($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        return $this->service->updateEvent($request, $event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        return response()->json($this->service->deleteEvent($event));
    }
}
