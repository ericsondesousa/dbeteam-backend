<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function notFoundMessage()
    {
        return __('plan.not_found');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
