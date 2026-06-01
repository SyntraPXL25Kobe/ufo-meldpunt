<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Notifications\NewReportAdmin;
use App\Notifications\NewReportUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function create(): View
    {
        return view('reports.create', [
            'categories' => Report::$categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'observed_at'  => ['required', 'date', 'before_or_equal:now'],
            'location'     => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'min:20'],
            'category'     => ['required', 'in:' . implode(',', array_keys(Report::$categories))],
            'photo'        => ['nullable', 'image', 'max:5120'],
        ], [
            'observed_at.required'       => 'Datum en tijd zijn verplicht.',
            'observed_at.before_or_equal' => 'De waarnemingsdatum mag niet in de toekomst liggen.',
            'location.required'          => 'Locatie is verplicht.',
            'description.required'       => 'Beschrijving is verplicht.',
            'description.min'            => 'Beschrijving moet minstens 20 tekens bevatten.',
            'category.required'          => 'Selecteer een categorie.',
            'photo.image'                => 'Het bestand moet een afbeelding zijn.',
            'photo.max'                  => 'De afbeelding mag maximaal 5 MB zijn.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reports', 'public');
        }

        $report = Report::create([
            'user_id'     => auth()->id(),
            'observed_at' => $validated['observed_at'],
            'location'    => $validated['location'],
            'description' => $validated['description'],
            'category'    => $validated['category'],
            'photo'       => $photoPath,
            'status'      => 'new',
        ]);

        // Notify the reporter (if logged in)
        if ($report->user) {
            $report->user->notify(new NewReportUser($report));
        }

        // Notify all admins
        User::where('role', 'admin')->each(function (User $admin) use ($report) {
            $admin->notify(new NewReportAdmin($report));
        });

        return redirect()->route('reports.thank-you');
    }

    public function thankYou(): View
    {
        return view('reports.thank-you');
    }
}
