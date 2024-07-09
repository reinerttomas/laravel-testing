<?php

declare(strict_types=1);

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\actingAs;

it('shows details for given video', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act & Assert
    $video = $course->videos->first();

    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeText([
            $video->title,
            $video->description,
            "({$video->duration_in_min}min)",
        ]);
});

it('shows given video', function () {
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act & Assert
    $video = $course->videos()->first();

    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeHtml('<iframe src="https://player.vimeo.com/video/' . $video->vimeo_id . '"');
});

it('shows list of all course videos', function () {
    // Arrange
    $course = Course::factory()
        ->has(
            Video::factory()
                ->count(3)
                ->state(new Sequence(
                    ['title' => 'Video A'],
                    ['title' => 'Video B'],
                    ['title' => 'Video C'],
                ))
        )
        ->create();

    // Act & Assert
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->assertSee([
            'Video A',
            'Video B',
            'Video C',
        ])
        ->assertSeeHtml([
            route('pages.course-videos', Video::where('title', 'Video A')->first()),
            route('pages.course-videos', Video::where('title', 'Video B')->first()),
            route('pages.course-videos', Video::where('title', 'Video C')->first()),
        ]);
});

it('marks video as completed', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory()->state(['title' => 'Course video']))
        ->create();

    $user->courses()->attach($course);

    // Assert
    expect($user->videos)->toHaveCount(0);

    // Act & Assert
    actingAs($user);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsCompleted');

    // Assert
    expect($user->refresh()->videos)
        ->toHaveCount(1)
        ->first()
        ->title->toBe('Course video');
});

it('marks video as not completed', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory()->state(['title' => 'Course video']))
        ->create();

    $user->courses()->attach($course);
    $user->videos()->attach($course->videos()->first());

    // Assert
    expect($user->videos)->toHaveCount(1);

    // Act & Assert
    actingAs($user);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos()->first()])
        ->call('markVideoAsNotCompleted');

    // Assert
    expect($user->refresh()->videos)
        ->toHaveCount(0);
});
