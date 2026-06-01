<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'UFO Meldpunt')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">

    <!-- Navigatie -->
    <nav class="bg-gray-900 border-b border-indigo-900 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-indigo-400 hover:text-indigo-300 transition">
                    <span class="text-2xl">🛸</span>
                    <span>UFO Meldpunt</span>
                </a>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-indigo-400 transition text-sm font-medium {{ request()->routeIs('home') ? 'text-indigo-400' : '' }}">Home</a>
                    <a href="{{ route('reports.create') }}" class="text-gray-300 hover:text-indigo-400 transition text-sm font-medium {{ request()->routeIs('reports.create') ? 'text-indigo-400' : '' }}">Meld een UFO</a>
                    @auth
                        <a href="{{ route('my-reports.index') }}" class="text-gray-300 hover:text-indigo-400 transition text-sm font-medium {{ request()->routeIs('my-reports.index') ? 'text-indigo-400' : '' }}">Mijn meldingen</a>
                    @endauth
                    <a href="{{ route('over-ons') }}" class="text-gray-300 hover:text-indigo-400 transition text-sm font-medium {{ request()->routeIs('over-ons') ? 'text-indigo-400' : '' }}">Over ons</a>
                </div>

                <!-- Auth buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <span class="text-sm text-gray-400 hidden md:inline">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="text-xs bg-indigo-700 hover:bg-indigo-600 text-white px-3 py-1.5 rounded-lg transition">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-400 hover:text-red-400 transition">Uitloggen</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-indigo-400 transition">Inloggen</a>
                        <a href="{{ route('register') }}" class="text-sm bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg transition font-medium">Registreren</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash berichten -->
    @if(session('success'))
        <div class="bg-green-800 border border-green-600 text-green-100 px-4 py-3 text-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hoofdinhoud -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-500 text-sm py-8 mt-auto">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="mb-2">🛸 <strong class="text-gray-400">UFO Meldpunt</strong> — Meld uw waarneming vertrouwelijk en anoniem.</p>
            <p class="text-xs">© {{ date('Y') }} UFO Meldpunt. Alle rechten voorbehouden.</p>
        </div>
    </footer>

</body>
</html>
