<?php

namespace App\Helper;

class EventHelper
{
    public static function qtyEventsIsExceeded(): bool
    {
        return auth()->user()->tenant->plan->events_limit >= auth()->user()->tenant->events->count();
    }
}
