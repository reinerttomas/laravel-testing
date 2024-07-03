<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('pages.dashboard'))
        ->assertRedirect(route('login'));
});

it('lists purchased courses', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()->count(2)->state(
            new Sequence(
                ['title' => 'Course A'],
                ['title' => 'Course B'],
            )
        ))
        ->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B',
        ]);
});

it('doest not list other courses', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.dashboard'))
        ->assertOk()
        ->assertDontSee($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();
    $courseA = Course::factory()->create();
    $courseB = Course::factory()->create();

    $user->courses()->attach($courseA, ['created_at' => CarbonImmutable::yesterday()]);
    $user->courses()->attach($courseB, ['created_at' => CarbonImmutable::now()]);

    // Act & Assert
    actingAs($user)
        ->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeInOrder([
            $courseB->title,
            $courseA->title,
        ]);
});

it('includes link to product videos', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory())
        ->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText('Watch videos')
        ->assertSee(route('pages.course-videos', Course::first()));
});

it('includes logout', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.dashboard'))
        ->assertOk()
        ->assertSeeText('Log Out')
        ->assertSee(route('logout'));
});
