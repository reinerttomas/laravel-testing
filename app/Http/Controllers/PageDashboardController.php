<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

use function compact;
use function current_user;

class PageDashboardController extends Controller
{
    public function __invoke(): View
    {
        $purchasedCourses = current_user()->purchasedCourses;

        return view('dashboard', compact('purchasedCourses'));
    }
}
