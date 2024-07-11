<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Video;
use App\Queries\Videos\CountAlreadyWatchedVideosQuery;

it('returns count already watched videos by user', function () {
    // Arrange
    $user = User::factory()
        ->has(Video::factory(), 'watchedVideos')
        ->create();

    $countWatchedVideos = (new CountAlreadyWatchedVideosQuery())->run($user, $user->watchedVideos()->firstOrFail());

    // Act & Assert
    expect($countWatchedVideos)->toEqual(1);
});
