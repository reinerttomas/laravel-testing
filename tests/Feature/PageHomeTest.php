<?php

declare(strict_types=1);

use App\Models\Course;
use Carbon\CarbonImmutable;

use function Pest\Laravel\get;

it('shows courses overview', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'description' => 'Description Course A', 'released_at' => CarbonImmutable::now()]);
    Course::factory()->create(['title' => 'Course B', 'description' => 'Description Course B', 'released_at' => CarbonImmutable::now()]);
    Course::factory()->create(['title' => 'Course C', 'description' => 'Description Course C', 'released_at' => CarbonImmutable::now()]);

    // Act & Assert
    get(route('home'))
        ->assertSee([
            'Course A',
            'Description Course A',
            'Course B',
            'Description Course B',
            'Course C',
            'Description Course C',
        ]);
});

it('shows only released courses', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'released_at' => CarbonImmutable::yesterday()]);
    Course::factory()->create(['title' => 'Course B']);

    // Act & Assert
    get(route('home'))
        ->assertSee([
            'Course A',
        ])
        ->assertDontSee([
            'Course B',
        ]);
});

it('shows courses by release date', function () {
    // Arrange
    Course::factory()->create(['title' => 'Course A', 'released_at' => CarbonImmutable::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'released_at' => CarbonImmutable::now()]);

    // Act & Assert
    get(route('home'))
        ->assertSeeInOrder([
            'Course B',
            'Course A',
        ]);
});
