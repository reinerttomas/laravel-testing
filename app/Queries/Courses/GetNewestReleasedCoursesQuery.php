<?php

declare(strict_types=1);

namespace App\Queries\Courses;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class GetNewestReleasedCoursesQuery
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Course>
     */
    public function run(): Collection
    {
        return Course::query()
            ->whereNotNull('released_at')
            ->orderByDesc('released_at')
            ->get();
    }
}
