<?php

declare(strict_types=1);

use App\Models\Course;
use App\Queries\Released;

it('only returns released courses for release scope ', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act & Assert
    expect(Course::released()->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});

it('only returns released courses for release tappable scope', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act & Assert
    expect(Course::query()->tap(new Released())->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});
