<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} - {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('es')->monthName }}
            {{ $currentYear }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Bienvenida --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">¡Bienvenido, {{ $user->name }}!</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Área:</span> {{ $user->work_area }} |
                                <span class="font-medium">Rol:</span>
                                @if($user->role === 'admin')
                                    <span class="text-red-600 dark:text-red-400">Administrador</span>
                                @elseif($user->role === 'manager')
                                    <span class="text-blue-600 dark:text-blue-400">Manager</span>
                                @else
                                    <span class="text-green-600 dark:text-green-400">Usuario</span>
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm {{ $planningPeriod['isActive'] ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' }}">
                                {{ $planningPeriod['isActive'] ? '✅ Período de planificación activo' : '⏰ Fuera de período' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Resumen personal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                {{-- Home Office este mes --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-800 mr-3">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Mis días Home Office</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $myHomeOfficeDays }} /
                                {{ $maxHomeOfficeDays }}</p>
                        </div>
                    </div>
                </div>

                {{-- Horario flexible --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-800 mr-3">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Mi horario</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $myFlexibleSchedule ? substr($myFlexibleSchedule->start_time, 0, 5) : '08:00' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Home office hoy (para managers) --}}
                @if($user->canManageAssignments())
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-800 mr-3">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Home Office hoy</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $teamHomeOfficeToday->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-800 mr-3">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Horarios flexibles</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $teamFlexibleCount }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Para usuarios normales, próximo home office --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 col-span-2">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-800 mr-3">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Próximo Home Office</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    @if($nextHomeOffice)
                                        {{ $nextHomeOffice->date->locale('es')->isoFormat('dddd D [de] MMMM') }}
                                    @else
                                        Sin asignar
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Calendario de Home Office (visible para todos) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            📅 Calendario de Home Office -
                            {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('es')->monthName }}
                        </h3>
                        @if($user->canManageAssignments())
                            <a href="{{ route('home-office.index') }}"
                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                Gestionar asignaciones →
                            </a>
                        @endif
                    </div>

                        {{-- Leyenda --}}
                        <div class="flex flex-wrap gap-4 mb-4 text-sm">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Tiene asignaciones</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Hoy</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Fin de semana</span>
                            </div>
                        </div>

                        {{-- Encabezados de días --}}
                        <div class="grid grid-cols-7 gap-2 mb-2">
                            @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $dayName)
                                <div class="text-center text-sm font-semibold text-gray-600 dark:text-gray-400 py-2 {{ in_array($dayName, ['Sáb', 'Dom']) ? 'text-gray-400' : '' }}">
                                    {{ $dayName }}
                                </div>
                            @endforeach
                        </div>

                        {{-- Calendario --}}
                        @php
                            $firstDay = Carbon\Carbon::create($currentYear, $currentMonth, 1);
                            $lastDay = $firstDay->copy()->endOfMonth();
                            $startPadding = $firstDay->dayOfWeekIso - 1;
                            $assignmentsByDate = $homeOfficeAssignments->groupBy(fn($a) => $a->date->format('Y-m-d'));
                        @endphp

                        <div class="grid grid-cols-7 gap-2">
                            {{-- Espacios vacíos --}}
                            @for($i = 0; $i < $startPadding; $i++)
                                <div class="h-20 bg-gray-50 dark:bg-gray-900 rounded-lg"></div>
                            @endfor

                            {{-- Días del mes --}}
                            @for($day = 1; $day <= $lastDay->day; $day++)
                                @php
                                    $currentDate = Carbon\Carbon::create($currentYear, $currentMonth, $day);
                                    $dateKey = $currentDate->format('Y-m-d');
                                    $isWeekend = $currentDate->isWeekend();
                                    $isToday = $currentDate->isToday();
                                    $dayAssignments = $assignmentsByDate->get($dateKey, collect());
                                    $hasAssignments = $dayAssignments->count() > 0;
                                @endphp
                                <div 
                                    @if($hasAssignments && !$isWeekend)
                                        onclick="openDayModal('{{ $dateKey }}', '{{ $currentDate->locale('es')->isoFormat('dddd D [de] MMMM') }}')"
                                    @endif 
                                    class="h-20 p-2 rounded-lg border-2 transition-all overflow-hidden
                                        {{ $isWeekend ? 'bg-gray-100 dark:bg-gray-900 border-gray-200 dark:border-gray-700 opacity-60' : 'bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700' }}
                                        {{ $isToday ? 'ring-2 ring-green-500 ring-offset-2 dark:ring-offset-gray-800' : '' }}
                                        {{ $hasAssignments && !$isWeekend ? 'cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/50 hover:border-blue-400 dark:hover:border-blue-500' : '' }}
                                    ">
                                    <div class="flex justify-between items-start">
                                        <span class="text-sm font-bold {{ $isToday ? 'text-green-600 dark:text-green-400' : ($isWeekend ? 'text-gray-400 dark:text-gray-500' : 'text-gray-700 dark:text-gray-300') }}">
                                            {{ $day }}
                                        </span>
                                        @if($hasAssignments && !$isWeekend)
                                            <span class="flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-blue-500 rounded-full shadow-sm">
                                                {{ $dayAssignments->count() }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($hasAssignments && !$isWeekend)
                                        <div class="mt-1 space-y-0.5">
                                            @foreach($dayAssignments->take(2) as $assignment)
                                                <p class="text-xs text-blue-600 dark:text-blue-400 truncate leading-tight">
                                                    {{ Str::before($assignment->user->name, ' ') }}
                                                </p>
                                            @endforeach
                                            @if($dayAssignments->count() > 2)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">+{{ $dayAssignments->count() - 2 }} más</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            @if($user->canManageAssignments())
            {{-- Horarios Flexibles del mes (solo managers/admin) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            ⏰ Horarios Flexibles -
                            {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('es')->monthName }}
                        </h3>
                        <a href="{{ route('flexible-schedule.index') }}"
                            class="text-sm text-green-600 hover:text-green-800 dark:text-green-400">
                            Gestionar horarios →
                        </a>
                    </div>

                    @if($flexibleAssignments->count() > 0)
                        {{-- Leyenda --}}
                        <div class="flex flex-wrap gap-4 mb-4 text-sm">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">08:00</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">08:30</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">09:00</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                                <span class="text-gray-600 dark:text-gray-400">Otros</span>
                            </div>
                        </div>

                        @php
                            $groupedByArea = $flexibleAssignments->groupBy(fn($a) => $a->user->work_area)->sortKeys();
                        @endphp

                        {{-- Grid de áreas (usa flex-wrap para adaptarse al contenido) --}}
                        <div class="flex flex-wrap gap-2">
                            @foreach($groupedByArea as $area => $areaAssignments)
                                <div 
                                    onclick="openFlexibleModal('{{ $area }}')"
                                    class="w-[calc(14.28%-0.5rem)] min-w-[120px] h-20 p-2 rounded-lg border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 cursor-pointer hover:bg-green-50 dark:hover:bg-green-900/30 hover:border-green-400 dark:hover:border-green-500 transition-all overflow-hidden">
                                    <div class="flex justify-between items-start">
                                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300 truncate" title="{{ $area }}">
                                            {{ Str::limit($area, 12) }}
                                        </span>
                                        <span class="flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-green-500 rounded-full shadow-sm">
                                            {{ $areaAssignments->count() }}
                                        </span>
                                    </div>
                                    <div class="mt-1 space-y-0.5">
                                        @foreach($areaAssignments->take(2) as $assignment)
                                            <p class="text-xs text-green-600 dark:text-green-400 truncate leading-tight">
                                                {{ Str::before($assignment->user->name, ' ') }}
                                            </p>
                                        @endforeach
                                        @if($areaAssignments->count() > 2)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">+{{ $areaAssignments->count() - 2 }} más</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Resumen total --}}
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-semibold">Total:</span> {{ $flexibleAssignments->count() }} persona(s) con horario flexible en {{ $groupedByArea->count() }} área(s)
                            </p>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No hay asignaciones de horario flexible este mes.</p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Accesos rápidos --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('home-office.index') }}"
                    class="block bg-blue-50 dark:bg-blue-900 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-lg p-6 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200">Home Office</h3>
                            <p class="text-blue-600 dark:text-blue-300 text-sm">
                                {{ $user->canManageAssignments() ? 'Asignar días de home office' : 'Ver mis asignaciones' }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('flexible-schedule.index') }}"
                    class="block bg-green-50 dark:bg-green-900 hover:bg-green-100 dark:hover:bg-green-800 rounded-lg p-6 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">Horario Flexible</h3>
                            <p class="text-green-600 dark:text-green-300 text-sm">
                                {{ $user->canManageAssignments() ? 'Asignar horarios flexibles' : 'Ver horarios del mes' }}
                            </p>
                        </div>
                        <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Modal para mostrar detalles del día (Home Office) --}}
    <div id="dayModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900 dark:text-gray-100"></h3>
                <button onclick="closeDayModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-3">
                {{-- Contenido dinámico --}}
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a id="modalLink" href="#" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                    Ver todas las asignaciones →
                </a>
            </div>
        </div>
    </div>

    {{-- Modal para mostrar detalles de horarios flexibles por área --}}
    <div id="flexibleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 id="flexibleModalTitle" class="text-lg font-medium text-gray-900 dark:text-gray-100"></h3>
                <button onclick="closeFlexibleModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="flexibleModalContent" class="space-y-3 max-h-80 overflow-y-auto">
                {{-- Contenido dinámico --}}
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('flexible-schedule.index') }}" class="text-sm text-green-600 hover:text-green-800 dark:text-green-400">
                    Gestionar horarios flexibles →
                </a>
            </div>
        </div>
    </div>

    {{-- Datos de asignaciones para JavaScript --}}
    <script>
        // Datos de Home Office
        const assignmentsByDate = @json($homeOfficeByDate);

        // Datos de Horarios Flexibles por área
        const flexibleByArea = @json($flexibleByArea);

        // Funciones para modal de Home Office
        function openDayModal(dateKey, formattedDate) {
            const modal = document.getElementById('dayModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');
            const link = document.getElementById('modalLink');

            title.innerHTML = '🏠 ' + formattedDate;
            link.href = '{{ route("home-office.index") }}';

            const assignments = assignmentsByDate[dateKey] || [];

            if (assignments.length > 0) {
                content.innerHTML = assignments.map(a => `
                    <div class="flex items-center p-3 bg-blue-50 dark:bg-blue-900 rounded-lg">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <p class="font-medium text-gray-800 dark:text-gray-200">${a.name}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${a.area}</p>
                        </div>
                    </div>
                `).join('');
            } else {
                content.innerHTML = '<p class="text-gray-500 dark:text-gray-400">No hay personas en home office este día.</p>';
            }

            modal.classList.remove('hidden');
        }

        function closeDayModal() {
            document.getElementById('dayModal').classList.add('hidden');
        }

        // Funciones para modal de Horarios Flexibles
        function openFlexibleModal(area) {
            const modal = document.getElementById('flexibleModal');
            const title = document.getElementById('flexibleModalTitle');
            const content = document.getElementById('flexibleModalContent');

            title.innerHTML = '⏰ ' + area;

            const assignments = flexibleByArea[area] || [];

            if (assignments.length > 0) {
                content.innerHTML = assignments.map(a => {
                    let colorClass = 'bg-purple-100 text-purple-700 dark:bg-purple-800 dark:text-purple-200';
                    if (a.time === '08:00') colorClass = 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200';
                    else if (a.time === '08:30') colorClass = 'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200';
                    else if (a.time === '09:00') colorClass = 'bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200';
                    
                    return `
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <p class="font-medium text-gray-800 dark:text-gray-200">${a.name}</p>
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-semibold ${colorClass}">${a.time}</span>
                        </div>
                    `;
                }).join('');
            } else {
                content.innerHTML = '<p class="text-gray-500 dark:text-gray-400">No hay personas con horario flexible en esta área.</p>';
            }

            modal.classList.remove('hidden');
        }

        function closeFlexibleModal() {
            document.getElementById('flexibleModal').classList.add('hidden');
        }

        // Cerrar modales al hacer clic fuera
        document.getElementById('dayModal').addEventListener('click', function (e) {
            if (e.target === this) closeDayModal();
        });

        document.getElementById('flexibleModal').addEventListener('click', function (e) {
            if (e.target === this) closeFlexibleModal();
        });
    </script>
</x-app-layout>