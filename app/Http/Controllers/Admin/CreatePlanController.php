<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CreatePlanController extends Controller
{
    private Plan $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {

        return Inertia('Admin/Plans/Index',[
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'role', 'trashed'),
            'plans' => $this->repository
                ->orderBy('price')
                ->filter(\Illuminate\Support\Facades\Request::only('search', 'role', 'trashed'))
                ->get()
                ->transform(fn ($plan) => [
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'slug' => $plan->slug,
                    'price' => $plan->price,
                    'deleted_at' => $plan->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia('Admin/Plans/Create');
    }

    public function store(StoreUpdatePlanRequest $request)
    {
        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $this->repository->create($data);

        return redirect()->route('central.pages.plans.index')
            ->with('success', 'Your plan has been created successfully');
    }

    public function show($id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if (!$plan)
            return redirect()->back();

        return view('central.pages.plans.view', compact('plan')
        );
    }

    public function edit(Plan $plan)
    {

        return Inertia('Admin/Plans/Edit',[
            'plan' =>  [
                'id' => $plan->id,
                'name' => $plan->name,
                'slug' => $plan->slug,
                'price' => $plan->price,
                'stripe_id' => $plan->stripe_id,
                'description' => $plan->description,
                'deleted_at' => $plan->deleted_at,
                ] ]);

    }

    public function update(StoreUpdatePlanRequest $request, $id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());


        return Redirect::back()->with('success', 'Plan successfully updated');
    }

    public function destroy($id)
    {
        $plan = $this->repository->where('id', $id)->first();

        if (!$plan)
            return redirect()->back();


        $plan -> delete();

        return Redirect()->back()
            ->with('success', 'Plan successfully deleted');


    }

    public function restore(Plan $plan)
    {
        $plan->restore();

        return Redirect::back()->with('success', 'Plan restored.');
    }




}
