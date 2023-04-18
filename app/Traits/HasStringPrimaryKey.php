<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasStringPrimaryKey
{
    protected static function bootHasStringPrimaryKey(): void
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = $model->generateUniqueId();
        });
    }

    public function generateUniqueId()
    {
        $base = $this->keyPrefix ?? $this->generateKeyBase();

        return $base.'_'.uniqid(true);
    }

    protected function generateKeyBase()
    {
        return Str::lower(Str::limit(class_basename($this), 3, ''));
    }
}
