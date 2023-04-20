<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
    ];

    protected $casts = [
        'thumbnail' => 'json',
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_members')
            ->withPivot('is_admin', 'is_favorite')
            ->withTimestamps();
    }

    public function hasUser(User $user)
    {
        return (bool)$this->members()->where('user_id', $user->id)->first();
    }

    public function isArchived()
    {
        return !is_null($this->archived_at);
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {

            $query->where(function ($query) use ($search) {
                $query->where('course_id', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            });

        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
