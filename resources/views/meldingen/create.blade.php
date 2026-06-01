@extends('layouts.app')

@section('title', 'UFO Melding indienen')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">

    <div class="text-center mb-10">
        <span class="text-5xl">🛸</span>
        <h1 class="text-3xl font-extrabold text-white mt-4 mb-2">Melding indienen</h1>
        <p class="text-gray-400">Vul het formulier zo volledig mogelijk in. Alle velden met <span class="text-red-400">*</span> zijn verplicht.</p>
    </div>

    @if($errors->any())
    <div class="bg-red-900/50 border border-red-700 rounded-xl p-4 mb-6">
        <p class="font-semibold text-red-300 mb-2">Corrigeer de volgende fouten:</p>
        <ul class="list-disc list-inside text-red-300 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('meldingen.store') }}" enctype="multipart/form-data"
          class="bg-gray-900 border border-gray-800 rounded-2xl p-8 space-y-6">
        @csrf

        {{-- Datum & tijd --}}
        <div>
            <label for="waarneming_datum" class="block text-sm font-semibold text-gray-200 mb-2">
                Datum & tijd waarneming <span class="text-red-400">*</span>
            </label>
            <input type="datetime-local" name="waarneming_datum" id="waarneming_datum"
                   value="{{ old('waarneming_datum') }}"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 @error('waarneming_datum') border-red-500 @enderror">
            @error('waarneming_datum')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Locatie --}}
        <div>
            <label for="locatie" class="block text-sm font-semibold text-gray-200 mb-2">
                Locatie <span class="text-red-400">*</span>
            </label>
            <input type="text" name="locatie" id="locatie"
                   value="{{ old('locatie') }}"
                   placeholder="Bijv. Amsterdam, Vondelpark"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 @error('locatie') border-red-500 @enderror">
            @error('locatie')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Categorie --}}
        <div>
            <label for="categorie" class="block text-sm font-semibold text-gray-200 mb-2">
                Categorie / soort waarneming <span class="text-red-400">*</span>
            </label>
            <select name="categorie" id="categorie"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 @error('categorie') border-red-500 @enderror">
                <option value="">— Selecteer een categorie —</option>
                @foreach($categorieen as $waarde => $label)
                    <option value="{{ $waarde }}" {{ old('categorie') === $waarde ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('categorie')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Beschrijving --}}
        <div>
            <label for="beschrijving" class="block text-sm font-semibold text-gray-200 mb-2">
                Beschrijving <span class="text-red-400">*</span>
            </label>
            <textarea name="beschrijving" id="beschrijving" rows="5"
                      placeholder="Beschrijf zo nauwkeurig mogelijk wat u heeft gezien: kleur, grootte, beweging, duur..."
                      class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 resize-none @error('beschrijving') border-red-500 @enderror">{{ old('beschrijving') }}</textarea>
            @error('beschrijving')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Foto --}}
        <div>
            <label for="foto" class="block text-sm font-semibold text-gray-200 mb-2">
                Foto uploaden <span class="text-gray-500">(optioneel, max. 5 MB)</span>
            </label>
            <input type="file" name="foto" id="foto" accept="image/*"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-gray-300 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-indigo-700 file:text-white hover:file:bg-indigo-600 focus:outline-none @error('foto') border-red-500 @enderror">
            @error('foto')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        @guest
        <div class="bg-indigo-900/30 border border-indigo-800 rounded-lg p-4 text-sm text-indigo-300">
            💡 <strong>Tip:</strong> <a href="{{ route('register') }}" class="underline hover:text-indigo-200">Registreer</a> of <a href="{{ route('login') }}" class="underline hover:text-indigo-200">log in</a> om uw meldingen te volgen en statsupdates per e-mail te ontvangen.
        </div>
        @endguest

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-4 rounded-xl text-lg transition shadow-lg shadow-indigo-900">
            Melding indienen →
        </button>
    </form>
</div>
@endsection
