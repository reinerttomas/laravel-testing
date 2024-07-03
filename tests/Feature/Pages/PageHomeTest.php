<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;
use Carbon\CarbonImmutable;

use function Pest\Laravel\actingAs;
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

it('includes login if not logged in', function () {
    // Act & Assert
    get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

it('includes logout if logged in', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    actingAs($user)
        ->get(route('pages.home'))
        ->assertOk()
        ->assertSeeText('Log out')
        ->assertSee(route('logout'));
});

it('doest not find Jetstream registration page', function () {
    // Act & Assert
    get('register')->assertNotFound();
});
