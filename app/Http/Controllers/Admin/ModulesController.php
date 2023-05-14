<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Lesson\UpdateDraggableLessonAction;
use App\Actions\Module\CreateModuleAction;
use App\Actions\Module\UpdateDraggableModuleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModulesController extends Controller
{

    public function store(CreateModuleRequest $request)
    {
        $module = Module::create([
            'course_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return Redirect::back();
    }

    public function update(CreateModuleRequest $request)
    {

        dd($request->all());
        $module = Module::where('id', $request->module_id)->update([
            'course_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $module;
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
