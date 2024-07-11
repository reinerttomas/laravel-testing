<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Queries\Courses\GetNewestReleasedCoursesQuery;
use Illuminate\View\View;

class PageHomeController extends Controller
{
    public function __invoke(GetNewestReleasedCoursesQuery $query): View
    {
        $courses = $query->run();

        return view('pages.home', compact('courses'));
    }
}
