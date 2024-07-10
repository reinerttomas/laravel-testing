<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Facades\Auth;
use Illuminate\View\View;

use function compact;

class PageDashboardController extends Controller
{
    public function __invoke(): View
    {
        $purchasedCourses = Auth::userOrFail()->purchasedCourses;

        return view('dashboard', compact('purchasedCourses'));
    }
}
