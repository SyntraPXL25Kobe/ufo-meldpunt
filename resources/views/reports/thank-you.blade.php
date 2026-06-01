@extends('layouts.app')

@section('title', 'Melding ontvangen')

@section('content')
<div class="max-w-xl mx-auto px-4 py-24 text-center">
    <div class="text-7xl mb-6">🛸</div>
    <h1 class="text-4xl font-extrabold text-white mb-4">Bedankt voor uw melding!</h1>
    <p class="text-gray-400 text-lg mb-8">
        Uw melding is succesvol ontvangen. Ons team zal deze zo snel mogelijk verwerken.<br>
        @auth
            U ontvangt een bevestiging per e-mail.
        @endauth
    </p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}"
           class="bg-gray-800 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-xl transition border border-gray-700">
            ← Terug naar home
        </a>
        <a href="{{ route('reports.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-6 py-3 rounded-xl transition">
            Nog een melding indienen
        </a>
        @auth
        <a href="{{ route('my-reports.index') }}"
           class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-xl transition border border-gray-600">
            Mijn meldingen bekijken
        </a>
        @endauth
    </div>
</div>
@endsection
