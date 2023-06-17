<?php

namespace App\Helper;

class PlayerHelper
{
    public static function qtyPlayersIsExceeded(): bool
    {
        return auth()->user()->tenant->players->count() >= auth()->user()->tenant->plan->players_limit;
    }

    public static function generateCode(int $qtyCharacters): string
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0, $qtyCharacters);
    }
}
