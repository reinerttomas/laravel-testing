<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

use function Pest\Laravel\actingAs;

it('belongs to a course', function () {
    // Arrange
    $video = Video::factory()
        ->has(Course::factory())
        ->create();

    // Act & Assert
    expect($video->course)
        ->toBeInstanceOf(Course::class);
});

it('gives back readable video duration', function () {
    // Arrange
    $video = Video::factory()->create(['duration_in_min' => 10]);

    // Act & Assert
    expect($video->getReadableDuration())->toBe('10min');
});

it('tells if current user not yet watched a given video', function () {
    // Arrange
    $user = User::factory()->create();
    $video = Video::factory()->create();

    // Act & Assert
    actingAs($user);
    expect($video->alreadyWatchedByCurrentUser())->toBeFalse();
});

it('tells if current user already watched a given video', function () {
    // Arrange
    $user = User::factory()
        ->has(Video::factory(), 'watchedVideos')
        ->create();

    // Act & Assert
    actingAs($user);
    expect($user->watchedVideos()->first()->alreadyWatchedByCurrentUser())->toBeTrue();
});
