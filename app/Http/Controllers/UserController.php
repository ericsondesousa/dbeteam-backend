<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        return $this->service->getAllWithTenant();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->service->getOneWithTenant($user->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        return $this->service->updateUser($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return response()->json($this->service->deleteUser($user));
    }
}
