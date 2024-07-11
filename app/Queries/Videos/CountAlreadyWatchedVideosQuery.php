<?php

declare(strict_types=1);

namespace App\Queries\Videos;

use App\Models\User;
use App\Models\Video;
use App\Scopes\Videos\IsVideo;

final readonly class CountAlreadyWatchedVideosQuery
{
    public function run(User $user, Video $video): int
    {
        return $user
            ->watchedVideos()
            ->tap(new IsVideo($video->id))
            ->count();
    }
}
