<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Services\TenantService;
use App\Http\Requests\TenantRequest;

class TenantController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new TenantService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->getAllWithUsers();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantRequest $request)
    {
        return $this->service->createTenant($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return $this->service->getOneWithUsers($tenant->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        return $this->service->updateTenant($request, $tenant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        return response()->json($this->service->deleteTenant($tenant));
    }
}
