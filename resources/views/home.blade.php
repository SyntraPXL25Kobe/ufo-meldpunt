@extends('layouts.app')

@section('title', 'UFO Meldpunt — Meld uw waarneming')

@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-b from-gray-950 via-indigo-950 to-gray-950 py-24 text-center overflow-hidden">
    <div class="absolute inset-0 pointer-events-none opacity-10">
        <div class="absolute top-10 left-1/4 w-96 h-96 bg-indigo-600 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-purple-600 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-3xl mx-auto px-4">
        <p class="text-indigo-400 text-sm font-semibold uppercase tracking-widest mb-4">Officieel meldpunt</p>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
            Heeft u iets<br><span class="text-indigo-400">onverklaarbaars</span> gezien?
        </h1>
        <p class="text-lg text-gray-300 mb-10">
            UFO Meldpunt is de centrale plek waar burgers veilig en anoniem onverklaarde luchtfenomenen kunnen melden.
            Uw melding draagt bij aan serieus onderzoek.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('reports.create') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-8 py-4 rounded-xl text-lg transition shadow-lg shadow-indigo-900">
                🛸 Dien een melding in
            </a>
            <a href="{{ route('over-ons') }}"
               class="bg-gray-800 hover:bg-gray-700 text-gray-200 font-medium px-8 py-4 rounded-xl text-lg transition">
                Meer over ons
            </a>
        </div>
    </div>
</section>

{{-- Statistieken --}}
<section class="bg-gray-900 py-12 border-y border-gray-800">
    <div class="max-w-4xl mx-auto px-4 grid grid-cols-3 gap-8 text-center">
        <div>
            <p class="text-3xl font-bold text-indigo-400">{{ \App\Models\Report::count() }}</p>
            <p class="text-sm text-gray-400 mt-1">Meldingen ontvangen</p>
        </div>
        <div>
            <p class="text-3xl font-bold text-indigo-400">{{ \App\Models\User::count() }}</p>
            <p class="text-sm text-gray-400 mt-1">Geregistreerde melders</p>
        </div>
        <div>
            <p class="text-3xl font-bold text-indigo-400">{{ \App\Models\Report::where('status', 'closed')->count() }}</p>
            <p class="text-sm text-gray-400 mt-1">Behandelde meldingen</p>
        </div>
    </div>
</section>

{{-- De 5 W's --}}
<section class="py-20 max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-white mb-12">Waarom melden?</h2>
    <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach([
            ['W', 'Wie?', 'Iedereen die een onverklaarbaar luchtfenomeen heeft waargenomen: burger, piloot of wetenschapper.'],
            ['W', 'Wat?', 'Onidentificeerbare vliegende objecten, mysterieuze lichten, ongewone vliegtuigmanoeuvres of fysieke sporen.'],
            ['W', 'Waar?', 'Elke locatie is relevant voor ons onderzoek.'],
            ['W', 'Wanneer?', 'Direct na de waarneming voor de meest nauwkeurige details, maar ook oudere meldingen zijn welkom.'],
            ['W', 'Waarom?', 'Om patronen te ontdekken, serieus onderzoek te faciliteren en bij te dragen aan transparantie over het fenomeen.'],
        ] as $item)
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-indigo-700 transition">
            <div class="text-3xl font-black text-indigo-400 mb-3">{{ $item[0] }}</div>
            <h3 class="font-bold text-white text-lg mb-2">{{ $item[1] }}</h3>
            <p class="text-gray-400 text-sm leading-relaxed">{{ $item[2] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Recente meldingen preview --}}
@php $recent = \App\Models\Report::latest()->take(3)->get(); @endphp
@if($recent->isNotEmpty())
<section class="bg-gray-900 py-16 border-y border-gray-800">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-white mb-8 text-center">Recente meldingen</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($recent as $report)
            <div class="bg-gray-950 rounded-xl border border-gray-800 p-5 hover:border-indigo-700 transition">
                @if($report->photo)
                    <img src="{{ Storage::url($report->photo) }}" alt="Foto melding" class="w-full h-36 object-cover rounded-lg mb-4">
                @else
                    <div class="w-full h-36 bg-gray-800 rounded-lg mb-4 flex items-center justify-center text-4xl">🛸</div>
                @endif
                <span class="text-xs font-semibold text-indigo-400 uppercase tracking-wide">{{ \App\Models\Report::$categories[$report->category] ?? $report->category }}</span>
                <p class="text-gray-300 text-sm mt-2 line-clamp-3">{{ $report->description }}</p>
                <p class="text-gray-500 text-xs mt-3">📍 {{ $report->location }} · {{ $report->observed_at->format('d-m-Y') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-white mb-4">Klaar om te melden?</h2>
        <p class="text-gray-400 mb-8">Uw melding is vertrouwelijk. Registreer gratis of dien direct in als gast.</p>
        <a href="{{ route('reports.create') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-10 py-4 rounded-xl text-lg transition shadow-lg shadow-indigo-900">
            Begin nu →
        </a>
    </div>
</section>

@endsection
