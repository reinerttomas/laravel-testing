<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageCourseDetailsController extends Controller
{
    public function __invoke(Course $course): View
    {
        if (! $course->released_at) {
            throw new NotFoundHttpException();
        }

        $course->loadCount('videos');

        return view('pages.details', compact('course'));
    }
}
