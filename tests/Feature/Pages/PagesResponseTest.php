<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    // Act & Assert
    get(route('pages.home'))
        ->assertOk();
});

it('returns a successful response for course details page', function () {
    // Arrange
    $course = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.course-details', $course))
        ->assertOk();
});

it('returns a successful response for dashboard page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    actingAs($user)
        ->get(route('dashboard'))
        ->assertOk();
});
