<?php

declare(strict_types=1);

namespace App\Queries\Videos;

use App\Models\User;
use App\Models\Video;

final readonly class CountAlreadyWatchedVideosQuery
{
    public function run(User $user, Video $video): int
    {
        return $user
            ->watchedVideos()
            ->where('video_id', $video->id)
            ->count();
    }
}
