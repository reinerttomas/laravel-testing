<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Video;
use App\Scopes\Courses\Released;

it('only returns released courses for release tappable scope', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act & Assert
    expect(Course::query()->tap(new Released())->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});

it('has videos', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->create();

    // Act & Assert
    expect($course->videos)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Video::class);
});
