<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\Plan\PlanResource;
use App\Models\Plan;
use App\Services\PlanService;

class PlanController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new PlanService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PlanResource::collection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        return new PlanResource($this->service->createPlan($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return new PlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        return new PlanResource($this->service->updatePlan($request, $plan));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        return response()->json($this->service->deletePlan($plan));
    }
}
