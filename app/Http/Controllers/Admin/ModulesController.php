<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Modules\GetAllModulesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ModulesResource;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $modules = app(GetAllModulesAction::class)->run(['perPage' => 10000]);


        return Inertia::render('Admin/Course/Modules/Index', [
            'modules' => ModulesResource::collection($modules),
            'course' => new CourseResource($course->load('modules')),

        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {

        $module = Module::findOrFail($module);


        return Inertia::render('Admin/Course/Modules/Show', [
            'module'=> $module
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
