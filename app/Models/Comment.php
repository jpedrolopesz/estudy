<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'user_id', 'lesson_id', 'title'
    ];
    protected $casts = [
        'comment' => 'array'
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }



    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) use ($filters) {
            $query->where(function ($query) use ($search, $filters) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhereHas('lesson', function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('first_name', 'like', '%'.$search.'%')
                            ->orWhere('last_name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    });

            });
        });
        $query->when($filters['reply'] ?? null, function ($query, $hasReplies) {
            if ($hasReplies === 'answered') {
                $query->whereHas('replies');
            } elseif ($hasReplies === 'unanswered') {
                $query->whereDoesntHave('replies');
            }
        });

    }


}




