<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

use function current_user;

class VideoPlayer extends Component
{
    public Video $video;

    /**
     * @var \Illuminate\Support\Collection<int, \App\Models\Video>
     */
    public Collection $courseVideos;

    public function mount(): void
    {
        $this->courseVideos = $this->video->course->videos;
    }

    public function render(): View
    {
        return view('livewire.video-player');
    }

    public function markVideoAsCompleted(): void
    {
        current_user()->watchedVideos()->attach($this->video);
    }

    public function markVideoAsNotCompleted(): void
    {
        current_user()->watchedVideos()->detach($this->video);
    }

    public function isCurrentVideo(Video $video): bool
    {
        return $this->video->is($video);
    }
}
