<?php

declare(strict_types=1);

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('cannot be accessed by guest', function () {
    // Arrange
    $course = Course::factory()->create();

    // Act & Assert
    get(route('pages.course-videos', $course))
        ->assertRedirect(route('login'));
});

it('includes video player', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.course-videos', $course))
        ->assertOk()
        ->assertSeeLivewire(VideoPlayer::class);
});

it('show first course video by default', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory()->state(['title' => 'My video']))
        ->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.course-videos', $course))
        ->assertOk()
        ->assertSeeText('My video');
});

it('shows provided course video', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()
        ->has(Video::factory()->count(2)->state(
            new Sequence(
                ['title' => 'Video A'],
                ['title' => 'Video B'],
            )
        ))
        ->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.course-videos', [
            'course' => $course,
            'video' => $course->videos()->orderByDesc('id')->first(),
        ]))
        ->assertOk()
        ->assertSeeText('Video B');
});
