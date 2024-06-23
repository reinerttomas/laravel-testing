<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'learnings' => 'array',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Video>
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder<\App\Models\Course>  $query
     * @return \Illuminate\Database\Eloquent\Builder<\App\Models\Course>
     */
    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('released_at');
    }
}
