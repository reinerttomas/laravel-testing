<?php

declare(strict_types=1);

namespace App\Scopes\Courses;

use App\Contracts\Scopes\Queryable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @implements Queryable<\App\Models\Course>
 */
final readonly class NewestReleased implements Queryable
{
    public function __invoke(Builder $query): void
    {
        $query->orderByDesc('released_at');
    }
}
