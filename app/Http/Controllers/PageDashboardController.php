<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use function auth;
use function compact;

class PageDashboardController extends Controller
{
    public function __invoke(): View
    {
        $purchasedCourses = auth()->user()->courses;

        return view('dashboard', compact('purchasedCourses'));
    }
}
