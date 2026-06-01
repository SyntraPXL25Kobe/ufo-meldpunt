<?php

namespace App\Http\Controllers;

/** @deprecated Use MyReportsController instead */
class MijnMeldingenController extends MyReportsController {}

use Illuminate\View\View;

class MijnMeldingenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $meldingen = auth()->user()
            ->meldingen()
            ->orderByDesc('created_at')
            ->get();

        return view('mijn-meldingen.index', compact('meldingen'));
    }
}
