@props(['currentYear', 'currentMonth', 'flexibleAssignments'])

@php
    // Agrupar por horario de ingreso, y dentro de cada horario por área
    $groupedByTime = $flexibleAssignments->groupBy(fn($a) => substr($a->start_time, 0, 5))->sortKeys();

    // Paleta amplia de colores para soportar cualquier cantidad de horarios
    $colorPalette = [
        ['bg' => 'bg-green-500', 'border' => 'border-green-400 dark:border-green-600', 'headerBg' => 'bg-green-100 dark:bg-green-900', 'text' => 'text-green-800 dark:text-green-200', 'badge' => 'bg-green-500', 'hover' => 'hover:bg-green-50 dark:hover:bg-green-900/30'],
        ['bg' => 'bg-yellow-500', 'border' => 'border-yellow-400 dark:border-yellow-600', 'headerBg' => 'bg-yellow-100 dark:bg-yellow-900', 'text' => 'text-yellow-800 dark:text-yellow-200', 'badge' => 'bg-yellow-500', 'hover' => 'hover:bg-yellow-50 dark:hover:bg-yellow-900/30'],
        ['bg' => 'bg-blue-500', 'border' => 'border-blue-400 dark:border-blue-600', 'headerBg' => 'bg-blue-100 dark:bg-blue-900', 'text' => 'text-blue-800 dark:text-blue-200', 'badge' => 'bg-blue-500', 'hover' => 'hover:bg-blue-50 dark:hover:bg-blue-900/30'],
        ['bg' => 'bg-purple-500', 'border' => 'border-purple-400 dark:border-purple-600', 'headerBg' => 'bg-purple-100 dark:bg-purple-900', 'text' => 'text-purple-800 dark:text-purple-200', 'badge' => 'bg-purple-500', 'hover' => 'hover:bg-purple-50 dark:hover:bg-purple-900/30'],
        ['bg' => 'bg-rose-500', 'border' => 'border-rose-400 dark:border-rose-600', 'headerBg' => 'bg-rose-100 dark:bg-rose-900', 'text' => 'text-rose-800 dark:text-rose-200', 'badge' => 'bg-rose-500', 'hover' => 'hover:bg-rose-50 dark:hover:bg-rose-900/30'],
        ['bg' => 'bg-teal-500', 'border' => 'border-teal-400 dark:border-teal-600', 'headerBg' => 'bg-teal-100 dark:bg-teal-900', 'text' => 'text-teal-800 dark:text-teal-200', 'badge' => 'bg-teal-500', 'hover' => 'hover:bg-teal-50 dark:hover:bg-teal-900/30'],
        ['bg' => 'bg-orange-500', 'border' => 'border-orange-400 dark:border-orange-600', 'headerBg' => 'bg-orange-100 dark:bg-orange-900', 'text' => 'text-orange-800 dark:text-orange-200', 'badge' => 'bg-orange-500', 'hover' => 'hover:bg-orange-50 dark:hover:bg-orange-900/30'],
        ['bg' => 'bg-cyan-500', 'border' => 'border-cyan-400 dark:border-cyan-600', 'headerBg' => 'bg-cyan-100 dark:bg-cyan-900', 'text' => 'text-cyan-800 dark:text-cyan-200', 'badge' => 'bg-cyan-500', 'hover' => 'hover:bg-cyan-50 dark:hover:bg-cyan-900/30'],
        ['bg' => 'bg-indigo-500', 'border' => 'border-indigo-400 dark:border-indigo-600', 'headerBg' => 'bg-indigo-100 dark:bg-indigo-900', 'text' => 'text-indigo-800 dark:text-indigo-200', 'badge' => 'bg-indigo-500', 'hover' => 'hover:bg-indigo-50 dark:hover:bg-indigo-900/30'],
        ['bg' => 'bg-pink-500', 'border' => 'border-pink-400 dark:border-pink-600', 'headerBg' => 'bg-pink-100 dark:bg-pink-900', 'text' => 'text-pink-800 dark:text-pink-200', 'badge' => 'bg-pink-500', 'hover' => 'hover:bg-pink-50 dark:hover:bg-pink-900/30'],
    ];

    // Asignar un color a cada horario de forma dinámica
    $timeColors = [];
    $paletteCount = count($colorPalette);
    foreach ($groupedByTime->keys() as $index => $time) {
        $timeColors[$time] = $colorPalette[$index % $paletteCount];
    }
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 flex items-center">
                <x-icons.time class="w-5 h-5 mr-2" /> Horarios Flexibles -
                {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('es')->monthName }}
            </h3>
            @if(auth()->user()->canManageAssignments())
                <a href="{{ route('flexible-schedule.index') }}"
                    class="text-sm text-green-600 hover:text-green-800 dark:text-green-400 inline-flex items-center">
                    Gestionar horarios <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        </div>

        @if($flexibleAssignments->count() > 0)
            {{-- Buscador --}}
            <div class="flex justify-end mb-4">
                <div class="relative">
                    <input type="text" id="flexibleSearch" placeholder="Buscar por nombre..."
                        class="w-48 pl-8 pr-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        onkeyup="filterFlexible(this.value)">
                    <svg class="w-4 h-4 absolute left-2.5 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Filas por horario de ingreso (vertical), áreas en horizontal --}}
            <div id="flexibleGrid" class="space-y-4">
                @foreach($groupedByTime as $time => $timeAssignments)
                    @php
                        $colors = $timeColors[$time] ?? $colorPalette[0];
                        $byArea = $timeAssignments->groupBy(fn($a) => $a->user->work_area)->sortKeys();
                    @endphp
                    <div class="flexible-time-group">
                        {{-- Encabezado del horario --}}
                        <div class="flex items-center justify-between px-3 py-2 rounded-t-lg {{ $colors['headerBg'] }}">
                            <div class="flex items-center">
                                <span class="w-3 h-3 {{ $colors['bg'] }} rounded-full mr-2"></span>
                                <span class="font-bold text-sm {{ $colors['text'] }}">{{ $time }}</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full text-white {{ $colors['badge'] }}">
                                {{ $timeAssignments->count() }}
                            </span>
                        </div>

                        {{-- Áreas en horizontal --}}
                        <div class="border-2 {{ $colors['border'] }} border-t-0 rounded-b-lg p-3">
                            <div class="flex flex-wrap gap-2">
                                @foreach($byArea as $area => $areaAssignments)
                                    <div data-area="{{ $area }}" data-time="{{ $time }}"
                                        onclick="openFlexibleModal('{{ $area }}', '{{ $time }}')"
                                        class="flexible-area min-w-[130px] flex-1 max-w-[200px] p-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-pointer {{ $colors['hover'] }} hover:border-current transition-all">
                                        <div class="flex justify-between items-center mb-1.5">
                                            <span
                                                class="text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide truncate"
                                                title="{{ $area }}">
                                                {{ Str::limit($area, 15) }}
                                            </span>
                                            <span
                                                class="text-xs font-semibold px-1.5 py-0.5 rounded-full text-white {{ $colors['badge'] }} ml-1 flex-shrink-0">
                                                {{ $areaAssignments->count() }}
                                            </span>
                                        </div>
                                        <div class="space-y-0.5">
                                            @foreach($areaAssignments as $assignment)
                                                <p class="text-xs text-gray-700 dark:text-gray-300 truncate leading-tight">
                                                    {{ Str::before($assignment->user->name, ' ') }}
                                                    {{ Str::before($assignment->user->last_name, ' ') }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Resumen total --}}
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Total:</span> {{ $flexibleAssignments->count() }} persona(s) con horario
                    flexible en {{ $groupedByTime->count() }} horario(s)
                </p>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">No hay asignaciones de horario flexible este mes.</p>
        @endif
    </div>
</div>