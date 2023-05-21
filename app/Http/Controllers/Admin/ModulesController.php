<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Lesson\UpdateDraggableLessonAction;
use App\Actions\Module\UpdateDraggableModuleAction;
use App\Http\Requests\Module\CreateUpdateModuleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function store(CreateUpdateModuleRequest $request)
    {
        $module = Module::create([
            'course_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return Redirect::back();
    }

    public function update(CreateUpdateModuleRequest $request, Course $course, Module $module): RedirectResponse
    {


        $module->update($request->all());


        return redirect()->back();

    }


    public function destroy(string $id)
    {
        //
    }



    public function updateDraggable(Request $request, Course $course): RedirectResponse
    {

       // $this->authorize('update', $course);
        if ($request->type == 'lesson') {
            UpdateDraggableLessonAction::run($request->payload);
        }

        if ($request->type == 'module') {
            UpdateDraggableModuleAction::run($request->payload);
        }

        return Redirect::back();
    }
}
