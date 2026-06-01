<?php

namespace App\Http\Controllers;

/** @deprecated Use ReportController instead */
class MeldingController extends ReportController {}

use App\Models\User;
use App\Notifications\NieuweMeldingAdmin;
use App\Notifications\NieuweMeldingMelder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MeldingController extends Controller
{
    public function create(): View
    {
        return view('meldingen.create', [
            'categorieen' => Melding::$categorieen,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'waarneming_datum' => ['required', 'date', 'before_or_equal:now'],
            'locatie'          => ['required', 'string', 'max:255'],
            'beschrijving'     => ['required', 'string', 'min:20'],
            'categorie'        => ['required', 'in:' . implode(',', array_keys(Melding::$categorieen))],
            'foto'             => ['nullable', 'image', 'max:5120'],
        ], [
            'waarneming_datum.required'      => 'Datum en tijd zijn verplicht.',
            'waarneming_datum.before_or_equal' => 'De waarnemingsdatum mag niet in de toekomst liggen.',
            'locatie.required'               => 'Locatie is verplicht.',
            'beschrijving.required'          => 'Beschrijving is verplicht.',
            'beschrijving.min'               => 'Beschrijving moet minstens 20 tekens bevatten.',
            'categorie.required'             => 'Selecteer een categorie.',
            'foto.image'                     => 'Het bestand moet een afbeelding zijn.',
            'foto.max'                       => 'De afbeelding mag maximaal 5 MB zijn.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('meldingen', 'public');
        }

        $melding = Melding::create([
            'user_id'          => auth()->id(),
            'waarneming_datum' => $validated['waarneming_datum'],
            'locatie'          => $validated['locatie'],
            'beschrijving'     => $validated['beschrijving'],
            'categorie'        => $validated['categorie'],
            'foto'             => $fotoPath,
            'status'           => 'nieuw',
        ]);

        // Notify the melder (if logged in)
        if ($melding->user) {
            $melding->user->notify(new NieuweMeldingMelder($melding));
        }

        // Notify all admins
        User::where('role', 'admin')->each(function (User $admin) use ($melding) {
            $admin->notify(new NieuweMeldingAdmin($melding));
        });

        return redirect()->route('meldingen.bedankt');
    }

    public function bedankt(): View
    {
        return view('meldingen.bedankt');
    }
}
