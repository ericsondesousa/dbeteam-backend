<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::all();
    }

    public function getAllWithTenant()
    {
        return User::with('tenant', 'tenant.plan')->get();
    }

    public function getOne(int $id)
    {
        return User::find($id);
    }

    public function getOneWithTenant(int $id)
    {
        return User::with('tenant', 'tenant.plan')->find($id);
    }

    public function updateUser(UserRequest $request, User $user)
    {
        $user->fill($request->validated());
        $user->save();
        return $user;
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
