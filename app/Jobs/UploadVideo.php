<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lesson;

    /**
     * Create a new job instance.
     */
    public function __construct($lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $pathToFile = $this->lesson->video_url;
        $uploadedFile = Storage::disk('public')->put('videos', $pathToFile);

        if ($uploadedFile) {
            $this->lesson->video_url = $uploadedFile;
            $this->lesson->save();
        } else {
            Log::error('Upload failed for lesson ID: ' . $this->lesson->id);
        }
    }
}
