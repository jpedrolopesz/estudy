<?php

namespace App\Http\Controllers\Admin\Uploads;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Course;
use App\Models\Task;
use App\Models\Media;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageUploadController extends Controller
{
    /**
     * @return MediaResource
     *
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function upload(Request $request, Course $course)
    {
        $file = $request->file('thumbnail');

        $media = $course->addMedia($file)->toMediaCollection('attachments');

        activity()
            ->performedOn($course)
            ->withProperties(['thumbnail' => $media->file_name])
            ->event('uploaded')
            ->log('uploaded');

        return new MediaResource($media);
    }


}
