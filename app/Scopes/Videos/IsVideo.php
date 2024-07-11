<?php

declare(strict_types=1);

namespace App\Scopes\Videos;

use App\Contracts\Scopes\Queryable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @implements Queryable<\App\Models\Video>
 */
final readonly class IsVideo implements Queryable
{
    public function __construct(public int $id) {}

    public function __invoke(Builder $query): void
    {
        $query->where('video_id', $this->id);
    }
}
