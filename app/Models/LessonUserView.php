<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonUserView extends Model
{
    use HasFactory;

    protected $table = 'lesson_user_views';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'watched_at',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
