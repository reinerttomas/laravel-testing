<?php

declare(strict_types=1);

namespace App\Queries;

use App\Contracts\CanBuildQuery;
use Illuminate\Database\Eloquent\Builder;

/**
 * @implements CanBuildQuery<\App\Models\Course>
 */
final readonly class Released implements CanBuildQuery
{
    public function __invoke(Builder $query): void
    {
        $query->whereNotNull('released_at');
    }
}
