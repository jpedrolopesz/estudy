<?php

namespace App\Models;

use App\Enums\Roles;
use App\Traits\HasAvatar;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\CausesActivity;
use function Illuminate\Events\queueable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,
        SoftDeletes, Billable, MustVerifyEmail,
        CausesActivity, HasAvatar;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'owner',
        'trial_ends_at',
        'is_active',
        'role',
        'should_be_logged_out',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'owner' => 'boolean',
        'should_be_logged_out' => 'boolean',
        'email_verified_at' => 'datetime',
        'role' => Roles::class,
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'courses.pivot.is_favorite' => 'boolean',
        'courses.pivot.is_admin' => 'boolean',

    ];

    protected static function booted()
    {
        static::updated(queueable(function ($user) {
            if ($user->hasStripeId()) {
                $user->syncStripeCustomerDetails();
            }
        }));
    }

    public function ownedCourses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_members')
            ->withPivot(['is_admin', 'is_favorite'])
            ->withTimestamps();
    }

    public function hasFavedCourse(Course $course)
    {
        if (!$course->hasUser($this)) {
            return false;
        }

        return (bool)$this->courses()->where('id', $course->id)
            ->first()?->pivot->is_favorite;
    }

    public function isCourseOwner(Course $course)
    {
        return $course->user_id == $this->id;
    }

    public function isCourseAdmin(Course $course)
    {
        if (!$course->hasUser($this)) {
            return false;
        }

        return $this->courses()->whereId($course->id)->first()?->pivot->is_admin;
    }

    public function isCourseAdminOrOwner(Course $course)
    {
        return $this->isCourseOwner($course) || $this->isCourseAdmin($course);
    }

    public function isGuestOnCourse($course)
    {
        return $this->courses->contains($course) &&
            $this->ownedCourses->doesntContain($course);
    }



    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function isAdminOrSuperAdmin()
    {
        return $this->role == Roles::SUPER_ADMIN || $this->role == Roles::ADMIN;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }


    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    public function scopeWhereRole($query, $role)
    {
        switch ($role) {
            case 'user': return $query->where('owner', false);
            case 'owner': return $query->where('owner', true);
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereRole($role);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Disabled';
    }

    #[SearchUsingPrefix(['first_name', 'last_name', 'email'])]
    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email
        ];
    }
}
