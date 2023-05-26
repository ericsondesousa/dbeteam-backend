<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('dev.date_format.br'));
    }

    public function notFoundMessage()
    {
        return __('plan.not_found');
    }
}