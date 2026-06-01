@extends('layouts.app')

@section('title', 'Registreren — UFO Meldpunt')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="text-center mb-8">
        <span class="text-4xl">👤</span>
        <h1 class="text-3xl font-extrabold text-white mt-4 mb-2">Account aanmaken</h1>
        <p class="text-gray-400">Registreer gratis om uw meldingen te volgen.</p>
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

    <form method="POST" action="{{ route('register') }}"
          class="bg-gray-900 border border-gray-800 rounded-2xl p-8 space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-200 mb-2">Volledige naam</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror">
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">E-mailadres</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 @error('email') border-red-500 @enderror">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">Wachtwoord</label>
            <input type="password" name="password" id="password" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror">
            <p class="text-gray-500 text-xs mt-1">Minimaal 8 tekens.</p>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-200 mb-2">Wachtwoord bevestigen</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500">
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition">
            Account aanmaken
        </button>
    </form>

    <p class="text-center text-gray-400 text-sm mt-6">
        Al een account? <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Inloggen</a>
    </p>
</div>
@endsection
