<?php

declare(strict_types=1);

use App\Models\Course;
use App\Queries\GetNewestReleasedCoursesQuery;
use Carbon\CarbonImmutable;

it('only returns released courses order by newest', function () {
    // Arrange
    Course::factory()->create();
    $courseA = Course::factory()->released(CarbonImmutable::yesterday())->create();
    $courseB = Course::factory()->released(CarbonImmutable::now())->create();

    $courses = (new GetNewestReleasedCoursesQuery())->run();

    // Act & Assert
    expect($courses)
        ->toHaveCount(2)
        ->and($courses[0])
        ->id
        ->toEqual($courseB->id)
        ->and($courses[1])
        ->id
        ->toEqual($courseA->id);
});
