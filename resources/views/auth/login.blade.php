@extends('layouts.app')

@section('title', 'Inloggen — UFO Meldpunt')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="text-center mb-8">
        <span class="text-4xl">🔐</span>
        <h1 class="text-3xl font-extrabold text-white mt-4 mb-2">Inloggen</h1>
        <p class="text-gray-400">Welkom terug bij het UFO Meldpunt.</p>
    </div>

    @if($errors->any())
    <div class="bg-red-900/50 border border-red-700 rounded-xl p-4 mb-6">
        <ul class="list-disc list-inside text-red-300 text-sm space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}"
          class="bg-gray-900 border border-gray-800 rounded-2xl p-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">E-mailadres</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">Wachtwoord</label>
            <input type="password" name="password" id="password" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-600 bg-gray-800 text-indigo-600">
            <label for="remember" class="text-sm text-gray-400">Onthoud mij</label>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition">
            Inloggen
        </button>
    </form>

    <p class="text-center text-gray-400 text-sm mt-6">
        Nog geen account? <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Registreer gratis</a>
    </p>
</div>
@endsection
