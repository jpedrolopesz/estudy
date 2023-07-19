<?php

namespace App\Models;

use App\Traits\HasAvatar;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
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
        'is_admin' => 'boolean',
    ];

    protected static function booted()
    {
        static::updated(queueable(function ($user) {
            if ($user->hasStripeId()) {
                $user->syncStripeCustomerDetails();
            }
        }));
    }


    /**
     * Get the courses owned by the user.
     */
    public function ownedCourses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function loginAttempts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LoginAttempt::class);
    }

    /**
     * Get the courses enrolled by the user.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_members')
            ->withPivot(['is_admin', 'is_favorite'])
            ->withTimestamps();
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withPivot('watched')->withTimestamps();
    }


    /**
     * Check if the user has favorited a course.
     */
    public function hasFavedCourse(Course $course)
    {
        if (!$course->hasUser($this)) {
            return false;
        }

        return (bool) $this->courses()->where('id', $course->id)
            ->first()?->pivot->is_favorite;
    }

    /**
     * Check if the user is the owner of a course.
     */
    public function isCourseOwner(Course $course)
    {
        return $course->user_id == $this->id;
    }

    /**
     * Check if the user is an admin of a course.
     */
    public function isCourseAdmin(Course $course)
    {
        if (!$course->hasUser($this)) {
            return false;
        }

        return $this->courses()->whereId($course->id)->first()?->pivot->is_admin;
    }

    /**
     * Check if the user is an admin or owner of a course.
     */
    public function isCourseAdminOrOwner(Course $course)
    {
        return $this->isCourseOwner($course) || $this->isCourseAdmin($course);
    }

    /**
     * Check if the user is a guest on a course.
     */
    public function isGuestOnCourse($course)
    {
        return $this->courses->contains($course) &&
            $this->ownedCourses->doesntContain($course);
    }

    /**
     * Resolve the route binding for the model.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->firstOrFail();
    }

    /**
     * Check if the user is an admin or super admin.
     */
    public function isAdminOrSuperAdmin()
    {
        return $this->role == Roles::SUPER_ADMIN || $this->role == Roles::ADMIN;
    }

    /**
     * Get the replies of the user.
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get the full name of the user.
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Hash the password attribute.
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }


    /**
     * Scope a query to filter by role.
     */
    public function scopeWhereRole($query, $role)
    {
        switch ($role) {
            case 'user':
                return $query->where('owner', false);
            case 'owner':
                return $query->where('owner', true);
            default:
                return $query;
        }
    }

    /**
     * Scope a query to apply filters.
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'a') {
                $query->withTrashed();
            } elseif ($trashed === 'd') {
                $query->onlyTrashed();
            }
        });
    }

    /**
     * Get the status attribute.
     */
    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Disabled';
    }

    /**
     * Make the model searchable.
     */
    #[SearchUsingPrefix(['first_name', 'last_name', 'email'])]
    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ];
    }
}
