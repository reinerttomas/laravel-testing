<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * @param  \Illuminate\Database\Eloquent\Builder<\App\Models\Course>  $query
     * @return \Illuminate\Database\Eloquent\Builder<\App\Models\Course>
     */
    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('released_at');
    }
}
