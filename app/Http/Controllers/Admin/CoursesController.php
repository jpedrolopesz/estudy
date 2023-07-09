<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Course\GetAllCoursesAction;
use App\Actions\Course\ShowCourseAction;
use App\Http\Requests\Course\CreateUpdateCourseRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\CourseResource;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class CoursesController extends Controller
{
    public function index(): \Inertia\Response
    {
        $course = GetAllCoursesAction::run(['perPage' => 10000]);

        return Inertia::render('Admin/Course/Index', [
            'courses' => CourseResource::collection($course),
            'course' => Course::all(),
        ]);
    }

    public function store(CreateUpdateCourseRequest $request): RedirectResponse
   {
       if ($request->hasFile('thumbnail')) {
           $image = $request->file('thumbnail');
           $filename = time() . '.' . $image->getClientOriginalExtension();
           $thumbnailPath = 'thumbnails/' . $filename;
           $thumbnail = Image::make($image)->resize(800, 500);

           Storage::disk('public')->put($thumbnailPath, $thumbnail->stream());
       } else {
           $thumbnailPath = null;
       }

       $course = Course::create([
           'user_id' => auth()->id(),
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'thumbnail' => $thumbnailPath,
       ]);

       return Redirect::route('course.edit', $course)
           ->with('success', 'Your request has been successfully completed.');
   }

    public function show($id): \Inertia\Response
    {
        return Inertia::render('Admin/Course/Show', [
            'course' => (new ShowCourseAction())->execute($id),

        ]);
    }


    public function edit(int $id): \Inertia\Response
    {

        return Inertia::render('Admin/Course/EditAndCreate', [
            'course' => (new ShowCourseAction())->execute($id),

        ]);
    }


    public function update(CreateUpdateCourseRequest $request, $id): RedirectResponse
    {
        $course = Course::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $oldPhotoPath = public_path('storage/' . $course->thumbnail);

            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }

            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $thumbnailPath = 'thumbnails/' . $filename;
            $thumbnail = Image::make($image)->resize(800, 500);

            Storage::disk('public')->put($thumbnailPath, $thumbnail->stream());
        } else {
            $thumbnailPath = $course->thumbnail;
        }

        $course->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'thumbnail' => $thumbnailPath,
        ]);

        return Redirect::back()->with('success', 'Your request has been successfully completed.');
    }


    public function destroy(string $id)
    {
        $course = Course::find($id);
        if ($course && $course->exists()) {
            $course->delete();
            return redirect()->back()->with('success', 'Your request has been successfully completed.');

        } else {
            return redirect()->back()->with('error', 'Error: Please check your request to resolve it efficiently.');

        }
    }

    public function restore(Course $course)
    {
        $course->restore();

        return back();

    }


}
