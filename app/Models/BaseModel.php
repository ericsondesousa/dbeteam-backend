<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::instance($date)->format(config('dev.date_format.default'));
    }
}
