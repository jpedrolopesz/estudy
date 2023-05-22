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

        return Redirect::back()->with('success', 'Your request has been successfully completed.');
    }

    public function update(CreateUpdateModuleRequest $request, Course $course, Module $module): RedirectResponse
    {


        $module->update($request->all());


        return Redirect::back()->with('success', 'Your request has been successfully completed.');

    }


    public function destroy(string $course, string $module)
    {
        $course = Course::find($course);
        $module = optional($course)->modules()->find($module);

        if ($module) {
            $module->delete();
            return Redirect::back()->with('success', 'Your request has been successfully completed.');
        } else {
            return Redirect::back()->with('error', 'Error: Please check your request to resolve it efficiently.');
        }
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

        return Redirect::back()->with('success', 'Your request has been successfully completed.');
    }
}
