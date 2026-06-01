@extends('layouts.app')

@section('title', 'Melding ontvangen — UFO Meldpunt')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-20 text-center">
    <div class="text-7xl mb-6">🛸</div>
    <h1 class="text-4xl font-extrabold text-white mb-4">Bedankt voor uw melding!</h1>
    <p class="text-gray-300 text-lg mb-4">
        Uw melding is succesvol ingediend en wordt zo spoedig mogelijk behandeld door ons team.
    </p>
    @auth
    <p class="text-gray-400 mb-8">
        U ontvangt een bevestiging per e-mail op <strong class="text-indigo-400">{{ auth()->user()->email }}</strong>.
        U kunt de status van uw melding volgen via "Mijn meldingen".
    </p>
    @else
    <p class="text-gray-400 mb-8">
        <a href="{{ route('register') }}" class="text-indigo-400 underline hover:text-indigo-300">Registreer een account</a>
        om uw meldingen te volgen en per e-mail op de hoogte te blijven.
    </p>
    @endauth

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}"
           class="bg-gray-800 hover:bg-gray-700 text-white font-medium px-8 py-3 rounded-xl transition">
            Terug naar home
        </a>
        <a href="{{ route('meldingen.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-8 py-3 rounded-xl transition">
            Nog een melding indienen
        </a>
        @auth
        <a href="{{ route('mijn-meldingen.index') }}"
           class="bg-indigo-900 hover:bg-indigo-800 text-indigo-300 font-medium px-8 py-3 rounded-xl transition border border-indigo-700">
            Mijn meldingen
        </a>
        @endauth
    </div>
</div>
@endsection
