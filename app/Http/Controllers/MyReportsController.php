<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MyReportsController extends Controller
{
    public function index(): View
    {
        $reports = auth()->user()
            ->reports()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('my-reports.index', compact('reports'));
    }
}
