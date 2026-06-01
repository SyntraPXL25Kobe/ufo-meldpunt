@extends('layouts.app')

@section('title', 'Mijn meldingen')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Mijn meldingen</h1>
            <p class="text-gray-400 mt-1">Overzicht van al uw ingediende UFO-meldingen</p>
        </div>
        <a href="{{ route('reports.create') }}"
           class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-5 py-2.5 rounded-xl transition text-sm">
            + Nieuwe melding
        </a>
    </div>

    @if($reports->isEmpty())
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-16 text-center">
            <div class="text-5xl mb-4">🔭</div>
            <p class="text-gray-400 text-lg mb-6">U heeft nog geen meldingen ingediend.</p>
            <a href="{{ route('reports.create') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-6 py-3 rounded-xl transition">
                Eerste melding indienen
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reports as $report)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-indigo-800 transition">
                <div class="flex flex-col md:flex-row md:items-start gap-4">

                    {{-- Photo thumbnail --}}
                    @if($report->photo)
                    <img src="{{ Storage::url($report->photo) }}" alt="Foto"
                         class="w-full md:w-32 h-24 object-cover rounded-lg flex-shrink-0">
                    @else
                    <div class="w-full md:w-32 h-24 bg-gray-800 rounded-lg flex items-center justify-center text-3xl flex-shrink-0">🛸</div>
                    @endif

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="text-xs font-semibold bg-indigo-900 text-indigo-300 px-2.5 py-1 rounded-full">
                                {{ \App\Models\Report::$categories[$report->category] ?? $report->category }}
                            </span>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                {{ $report->status === 'new' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                {{ $report->status === 'in_progress' ? 'bg-blue-900 text-blue-300' : '' }}
                                {{ $report->status === 'closed' ? 'bg-green-900 text-green-300' : '' }}">
                                {{ \App\Models\Report::$statuses[$report->status] ?? $report->status }}
                            </span>
                        </div>
                        <p class="text-gray-300 text-sm line-clamp-2">{{ $report->description }}</p>
                        <div class="flex flex-wrap gap-4 mt-3 text-xs text-gray-500">
                            <span>📍 {{ $report->location }}</span>
                            <span>🗓 {{ $report->observed_at->format('d-m-Y H:i') }}</span>
                            <span>📋 Ingediend op {{ $report->created_at->format('d-m-Y') }}</span>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $reports->links() }}
        </div>
    @endif

</div>
@endsection
