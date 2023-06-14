<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Lesson extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'video_url',
        'sort_order',
        'watched',
        'comments'
    ];


    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function lessonUserViews()
    {
        return $this->hasMany(LessonUserView::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('watched')->withTimestamps();
    }


}
