<?php

namespace App\Livewire;

use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class VideoPlayer extends Component
{
    public Video $video;

    public function render(): View
    {
        return view('livewire.video-player');
    }
}
