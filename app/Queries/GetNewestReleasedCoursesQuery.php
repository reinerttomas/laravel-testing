<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Course;
use App\Queries\Scopes\NewestReleased;
use App\Queries\Scopes\Released;
use Illuminate\Database\Eloquent\Collection;

class GetNewestReleasedCoursesQuery
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Course>
     */
    public function run(): Collection
    {
        return Course::query()
            ->tap(new Released())
            ->tap(new NewestReleased())
            ->get();
    }
}
