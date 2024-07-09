<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Video;

it('belongs to a course', function () {
    // Arrange
    $user = Video::factory()
        ->has(Course::factory())
        ->create();

    // Act & Assert
    expect($user->course)
        ->toBeInstanceOf(Course::class);
});

it('gives back readable video duration', function () {
    // Arrange
    $video = Video::factory()->create(['duration_in_min' => 10]);

    // Act & Assert
    expect($video->getReadableDuration())->toBe('10min');
});
