<?php

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\App;

it('adds given courses', function () {
    // Arrange
    $this->assertDatabaseCount(Course::class, 0);

    // Act
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Course::class, 3);
    $this->assertDatabaseHas(Course::class, ['title' => 'Laravel For Beginners']);
    $this->assertDatabaseHas(Course::class, ['title' => 'Advanced Laravel']);
    $this->assertDatabaseHas(Course::class, ['title' => 'TDD The Laravel Way']);
});

it('adds given courses only once', function () {
    // Arrange
    $this->assertDatabaseCount(Course::class, 0);

    // Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Course::class, 3);
});

it('adds given videos', function () {
    $this->assertDatabaseCount(Video::class, 0);

    // Act
    $this->artisan('db:seed');

    $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->first();
    $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->first();
    $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();

    // Assert
    expect($laravelForBeginnersCourse)
        ->videos
        ->toHaveCount(3);

    expect($advancedLaravelCourse)
        ->videos
        ->toHaveCount(3);

    expect($tddTheLaravelWayCourse)
        ->videos
        ->toHaveCount(2);
});

it('adds given videos only once', function () {
    $this->assertDatabaseCount(Video::class, 0);

    // Act
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(Video::class, 8);
});

it('adds local test user', function () {
    // Arrange
    App::macro('setEnvLocal', function (): void {
        $this['env'] = 'local';
    });
    App::setEnvLocal();

    $this->assertDatabaseCount(User::class, 0);

    // Act
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(User::class, 1);
});

it('does not adds test user for production', function () {
    // Arrange
    $this->assertDatabaseCount(User::class, 0);

    // Act
    $this->artisan('db:seed');

    // Assert
    $this->assertDatabaseCount(User::class, 0);
});
