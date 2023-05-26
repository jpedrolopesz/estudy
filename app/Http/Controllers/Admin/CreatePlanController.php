<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Plan\GetAllPlansAction;
use App\Actions\Plan\ShowPlanAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdatePlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CreatePlanController extends Controller
{


    public function index(): \Inertia\Response
    {
        $plan = GetAllPlansAction::run(['perPage' => 10000]);

        return Inertia('Admin/Plans/Index',[
            'plans' => PlanResource::collection($plan),
        ]);
    }

    public function create()
    {
        return Inertia('Admin/Plans/Create');
    }

    public function store(StoreUpdatePlanRequest $request, Plan $plan)
    {

        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $plan = $plan->create($data);

        $plan->planFeatures()->create([
             'max_users' => $request->max_users,
            ]);


        return Redirect::route('plan.index')
            ->with('success', 'Your plan has been created successfully');
    }



    public function edit(int $id): \Inertia\Response
    {
        return Inertia::render('Admin/Plans/Edit', [
            'plan' => Plan::with('planFeatures')->find($id)

        ]);
    }

    public function update(StoreUpdatePlanRequest $request, $id)
    {
        $plan = Plan::where('id', $id)->first();


        if (!$plan)
            return redirect()->back();

        $plan->planFeatures()->update([
            'max_users' => $request->max_users,
        ]);

        $plan->update($request->all());


        return Redirect::back()->with('success', 'Plan successfully updated');
    }

    public function destroy($id)
    {
        $plan = Plan::where('id', $id)->first();

        if (!$plan)
            return redirect()->back();


        $plan-> delete();

        return Redirect()->back()
            ->with('success', 'Plan successfully deleted');


    }

    public function restore(Plan $plan)
    {
        $plan->restore();

        return Redirect::back()->with('success', 'Plan restored.');
    }




}
