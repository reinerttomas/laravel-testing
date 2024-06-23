<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;

class PageCourseDetailsController extends Controller
{
    public function __invoke(Course $course): View
    {
        return view('course.details', compact('course'));
    }
}
