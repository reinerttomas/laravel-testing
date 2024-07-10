<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Video;
use App\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

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
        Auth::userOrFail()->watchedVideos()->attach($this->video);
    }

    public function markVideoAsNotCompleted(): void
    {
        Auth::userOrFail()->watchedVideos()->detach($this->video);
    }

    public function isCurrentVideo(Video $video): bool
    {
        return $this->video->is($video);
    }
}
