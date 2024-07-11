<?php

declare(strict_types=1);

namespace App\Queries\Courses;

use App\Models\Course;
use App\Scopes\Courses\NewestReleased;
use App\Scopes\Courses\Released;
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
