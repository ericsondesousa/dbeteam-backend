<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Player;
use App\Services\PlayerService;
use ErrorException;

class PlayerConfirmationController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new PlayerService();
    }

    /**
     * Display a listing of the resource.
     */
    public function toggle(Event $event, Player $player)
    {
        if ($player->event_id !== $event->id) {
            throw new ErrorException(__('player.not_found'), 404);
        }

        return $this->service->toggleConfirmation($event, $player);
    }
}
