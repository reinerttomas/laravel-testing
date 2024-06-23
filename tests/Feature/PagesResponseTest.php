<?php

declare(strict_types=1);

use App\Models\Course;

use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    // Act & Assert
    get(route('home'))
        ->assertOk();
});

it('returns a successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('course.details', $course))
        ->assertOk();
});
