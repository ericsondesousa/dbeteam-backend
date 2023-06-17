<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerConfirmation extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [];

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            $model->confirmed_at = $model->freshTimestamp();
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
