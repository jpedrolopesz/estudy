<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'url',
        'slug',
        'name',
        'price',
        'price_currency',
        'plan_features',
        'stripe_id',
        'active',
        'recommended',
        'description',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'user_id');
    }


    public function planFeatures(): HasOne
    {
        return $this->hasOne(PlanFeature::class, 'plan_id');
    }





    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'a') {
                $query->withTrashed();
            } elseif ($trashed === 'd') {
                $query->onlyTrashed();
            }
        });
    }
}
