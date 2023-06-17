<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Services\PlayerService;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'updated_at',
        'event_id'
    ];

    protected $casts = [];

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            $service = new PlayerService;
            $event = Event::find($model->event_id);
            $model->tenant_id = $event->tenant_id ?? auth()->user()->tenant_id;
            $model->code = $service->generateCode($model->event_id);
        });
    }

    public function notFoundMessage()
    {
        return __('player.not_found');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function confirmations()
    {
        return $this->hasMany(PlayerConfirmation::class);
    }
}
