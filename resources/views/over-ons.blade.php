@extends('layouts.app')

@section('title', 'Over ons — UFO Meldpunt')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">

    <div class="text-center mb-14">
        <span class="text-5xl">🌌</span>
        <h1 class="text-4xl font-extrabold text-white mt-4 mb-4">Over UFO Meldpunt</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">Wij zijn een onafhankelijk platform dat onverklaarbare luchtfenomenen registreert, analyseert en documenteert.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-10 mb-16">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-xl font-bold text-indigo-400 mb-4">Onze missie</h2>
            <p class="text-gray-300 leading-relaxed">
                UFO Meldpunt werd opgericht met één doel: burgers een veilig en laagdrempelig kanaal bieden om onverklaarde luchtfenomenen te melden.
                We geloven dat transparantie en serieus onderzoek essentieel zijn om dit fenomeen beter te begrijpen.
            </p>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8">
            <h2 class="text-xl font-bold text-indigo-400 mb-4">Wat we doen</h2>
            <p class="text-gray-300 leading-relaxed">
                Elke melding wordt zorgvuldig geregistreerd en beoordeeld door ons team van onderzoekers.
                We analyseren patronen, vergelijken meldingen en werken samen met internationale netwerken voor UFO-onderzoek.
            </p>
        </div>
    </div>

    <div class="bg-gray-900 border border-indigo-900 rounded-2xl p-10 text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Doe mee</h2>
        <p class="text-gray-300 mb-8 max-w-xl mx-auto">
            Heeft u iets onverklaarbaars gezien? Uw melding — hoe klein ook — kan een cruciale schakel zijn in ons onderzoek.
            Melden is gratis, vertrouwelijk en anoniem mogelijk.
        </p>
        <a href="{{ route('reports.create') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-10 py-4 rounded-xl text-lg transition">
            🛸 Dien uw melding in
        </a>
    </div>
</div>
@endsection
