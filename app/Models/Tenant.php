<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Tenant extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'updated_at',
        'plan_id'
    ];

    protected $casts = [
        'is_subscriber' => 'boolean'
    ];

    public function notFoundMessage()
    {
        return __('tenant.not_found');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
