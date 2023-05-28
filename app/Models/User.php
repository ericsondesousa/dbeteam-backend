<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use DateTimeInterface;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'plan_id',
        'last_access',
        'email_verified_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->plan_id = 1;
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::instance($date)->format(config('dev.date_format.default'));
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
