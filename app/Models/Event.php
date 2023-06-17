<?php

namespace App\Models;

use App\Helper\Dev;
use App\Models\BaseModel;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'updated_at'
    ];

    protected $casts = [
        'has_queue' => 'boolean',
        'closed' => 'boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            $model->token = Dev::generateToken();
        });
    }

    public function notFoundMessage()
    {
        return __('event.not_found');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function confirmations()
    {
        return $this->hasMany(PlayerConfirmation::class);
    }
}
