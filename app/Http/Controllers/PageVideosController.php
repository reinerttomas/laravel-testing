<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\View\View;

use function compact;

class PageVideosController extends Controller
{
    public function __invoke(Course $course, ?Video $video): View
    {
        $video = $video?->exists ? $video : $course->videos()->first();

        return view('pages.course-videos', compact('video'));
    }
}
