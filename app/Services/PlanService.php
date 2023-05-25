<?php

namespace App\Services;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;

class PlanService
{
    public function getAll()
    {
        return Plan::all();
    }

    public function getOne(int $id)
    {
        return Plan::find($id);
    }

    public function createPlan(PlanRequest $request)
    {
        return Plan::create($request->validated());
    }

    public function updatePlan(PlanRequest $request, Plan $plan)
    {
        $plan->fill($request->validated());
        $plan->save();
        return $plan;
    }

    public function deletePlan(Plan $plan)
    {
        return $plan->delete();
    }
}
