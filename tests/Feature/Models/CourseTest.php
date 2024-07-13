<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Video;

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
