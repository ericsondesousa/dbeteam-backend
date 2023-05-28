<?php

namespace App\Services;

use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Carbon\Carbon;

class TenantService
{
    public function getAll()
    {
        return Tenant::all();
    }

    public function getAllWithUsers()
    {
        return Tenant::with('users')->get();
    }

    public function getOne(int $id)
    {
        return Tenant::find($id);
    }

    public function getOneWithUsers(int $id)
    {
        return Tenant::with('users')->find($id);
    }

    public function createTenant(TenantRequest $request)
    {
        $data = $request->validated();
        $data['expired_at'] = Carbon::now()->addDays(15);

        return Tenant::create($data);
    }

    public function updateTenant(TenantRequest $request, Tenant $tenant)
    {
        $tenant->fill($request->validated());
        $tenant->save();
        return $tenant;
    }

    public function deleteTenant(Tenant $tenant)
    {
        return $tenant->delete();
    }
}
