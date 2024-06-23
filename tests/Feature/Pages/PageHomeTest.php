<?php

declare(strict_types=1);

use App\Models\Course;
use Carbon\CarbonImmutable;

use function Pest\Laravel\get;

it('shows courses overview', function () {
    // Arrange
    $course1 = Course::factory()->released()->create();
    $course2 = Course::factory()->released()->create();
    $course3 = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSee([
            $course1->title,
            $course1->description,
            $course2->title,
            $course2->description,
            $course3->title,
            $course3->description,
        ]);
});

it('shows only released courses', function () {
    // Arrange
    $releasedCourse = Course::factory()->released()->create();
    $notReleasedCourse = Course::factory()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSee($releasedCourse->title)
        ->assertDontSee($notReleasedCourse->title);
});

it('shows courses by release date', function () {
    // Arrange
    $course1 = Course::factory()->released(CarbonImmutable::yesterday())->create();
    $course2 = Course::factory()->released()->create();

    // Act & Assert
    get(route('pages.home'))
        ->assertSeeInOrder([
            $course2->title,
            $course1->title,
        ]);
});
