@extends('layouts.app')

@section('title', 'Mijn meldingen — UFO Meldpunt')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Mijn meldingen</h1>
            <p class="text-gray-400 mt-1">Overzicht van al uw ingediende UFO-meldingen.</p>
        </div>
        <a href="{{ route('meldingen.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-6 py-3 rounded-xl transition text-sm">
            + Nieuwe melding
        </a>
    </div>

    @if($meldingen->isEmpty())
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-16 text-center">
        <div class="text-5xl mb-4">🔭</div>
        <p class="text-gray-400 text-lg mb-6">U heeft nog geen meldingen ingediend.</p>
        <a href="{{ route('meldingen.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-8 py-3 rounded-xl transition">
            Eerste melding indienen
        </a>
    </div>
    @else
    <div class="space-y-4">
        @foreach($meldingen as $melding)
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 hover:border-indigo-800 transition flex gap-6">
            {{-- Foto preview --}}
            <div class="flex-shrink-0">
                @if($melding->foto)
                    <img src="{{ Storage::url($melding->foto) }}" alt="Foto"
                         class="w-20 h-20 object-cover rounded-lg border border-gray-700">
                @else
                    <div class="w-20 h-20 bg-gray-800 rounded-lg border border-gray-700 flex items-center justify-center text-3xl">🛸</div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="text-xs font-semibold text-indigo-400 uppercase tracking-wide">
                            {{ \App\Models\Melding::$categorieen[$melding->categorie] ?? $melding->categorie }}
                        </span>
                        <p class="text-gray-300 text-sm mt-1 line-clamp-2">{{ $melding->beschrijving }}</p>
                    </div>
                    <span class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-semibold
                        @if($melding->status === 'nieuw') bg-yellow-900 text-yellow-300
                        @elseif($melding->status === 'in_behandeling') bg-blue-900 text-blue-300
                        @else bg-green-900 text-green-300
                        @endif">
                        {{ \App\Models\Melding::$statussen[$melding->status] ?? $melding->status }}
                    </span>
                </div>
                <div class="flex gap-4 mt-3 text-xs text-gray-500">
                    <span>📍 {{ $melding->locatie }}</span>
                    <span>📅 {{ $melding->waarneming_datum->format('d-m-Y H:i') }}</span>
                    <span>🕐 Ingediend {{ $melding->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
