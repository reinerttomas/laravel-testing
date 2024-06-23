<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;

it('shows course details', function () {
    // Arrange
    $course = Course::factory()->create([
        'tagline' => 'Course tagline',
        'image' => 'image.png',
        'learnings' => [
            'Learn Laravel routes',
            'Learn Laravel views',
            'Learn Laravel commands',
        ],
    ]);

    // Act & Assert
    get(route('course.details', $course))
        ->assertOk()
        ->assertSee([
            $course->title,
            $course->description,
            'Course tagline',
            'Learn Laravel routes',
            'Learn Laravel views',
            'Learn Laravel commands',
        ])
        ->assertSee('image.png');
});

it('shows course video count', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->create();

    // Act & Assert
    get(route('course.details', $course))
        ->assertOk()
        ->assertSeeText('3 videos');
});
