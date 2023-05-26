<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
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
        return $this->service->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        return $this->service->createPlan($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return $plan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        return $this->service->updatePlan($request, $plan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        return response()->json($this->service->deletePlan($plan));
    }
}
