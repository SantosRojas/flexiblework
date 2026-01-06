<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Asignación de Home Office') }} -
                {{ Carbon\Carbon::create($year, $month, 1)->locale('es')->monthName }} {{ $year }}
            </h2>
            @if(Auth::user()->canManageAssignments())
                <a href="{{ route('home-office.report', ['month' => $month, 'year' => $year]) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
                    Ver Reporte
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes de éxito/error --}}
            @if(session('success'))
                <div
                    class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div
                    class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Contenido principal según el período de planificación --}}
            @if($planningPeriod['isActive'] || Auth::user()->isAdmin())

                {{-- Período activo - Mostrar formulario de asignación --}}
                @if(Auth::user()->canManageAssignments())
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            {{-- Información del período activo --}}
                            <div class="mb-6 p-4 rounded-lg bg-green-100 dark:bg-green-900">
                                <p class="text-sm text-green-800 dark:text-green-200">
                                    <span class="font-semibold">✅ Período de planificación activo</span>
                                    <br>
                                    <span class="text-xs">Del {{ $planningPeriod['start']->format('d/m/Y') }} al
                                        {{ $planningPeriod['end']->format('d/m/Y') }}</span>
                                </p>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                Asignar día de Home Office
                                @if(Auth::user()->isAdmin() && !$planningPeriod['isActive'])
                                    <span class="text-sm font-normal text-yellow-600">(Modo Admin - fuera de período)</span>
                                @endif
                            </h3>

                            {{-- Información de límites --}}
                            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-blue-50 dark:bg-blue-900 p-3 rounded-lg">
                                    <p class="text-sm text-blue-800 dark:text-blue-200">
                                        <span class="font-semibold">📊 Máximo:</span> {{ $maxDaysPerMonth }} días/mes
                                    </p>
                                </div>
                                <div class="bg-purple-50 dark:bg-purple-900 p-3 rounded-lg">
                                    <p class="text-sm text-purple-800 dark:text-purple-200">
                                        <span class="font-semibold">👥 Por día:</span> {{ $maxPeoplePerDay }} personas
                                    </p>
                                </div>
                            </div>

                            <form action="{{ route('home-office.store') }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <x-input-label for="user_id" value="Empleado" />
                                    <select name="user_id" id="user_id" required
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">Seleccionar empleado...</option>
                                        @foreach($teamMembers as $member)
                                            <option value="{{ $member->id }}">
                                                {{ $member->name }}
                                                @if(Auth::user()->isAdmin())
                                                    [{{ $member->work_area }}]
                                                @endif
                                                ({{ $member->homeOfficeDaysInMonth($month, $year) }}/{{ $maxDaysPerMonth }} días usados)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="date" value="Fecha de Home Office" />
                                    <input type="text" name="date" id="date" required readonly
                                        placeholder="Selecciona una fecha..."
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm cursor-pointer">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        📅 Solo días hábiles desde hoy hasta fin de
                                        {{ Carbon\Carbon::create($year, $month, 1)->locale('es')->monthName }} (fines de semana deshabilitados)
                                    </p>
                                </div>

                                <div class="pt-4">
                                    <x-primary-button class="w-full justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Asignar Home Office
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Lista de asignaciones actuales del mes --}}
                    @if($assignments->count() > 0)
                        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                                    Asignaciones de {{ Carbon\Carbon::create($year, $month, 1)->locale('es')->monthName }}
                                </h3>
                                <div class="space-y-2">
                                    @foreach($assignments->sortBy('date') as $assignment)
                                        <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <span
                                                    class="font-medium text-gray-800 dark:text-gray-200">{{ $assignment->user->name }}</span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                                                    {{ Carbon\Carbon::parse($assignment->date)->locale('es')->isoFormat('dddd D [de] MMMM') }}
                                                </span>
                                            </div>
                                            @if(Auth::user()->canManageAssignments() && (Auth::user()->isAdmin() || $assignment->user->work_area === Auth::user()->work_area))
                                                <form action="{{ route('home-office.destroy', $assignment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                                                        onclick="return confirm('¿Eliminar esta asignación?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Usuario sin permisos --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Acceso restringido</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                No tienes permisos para asignar días de home office.
                            </p>
                        </div>
                    </div>
                @endif

            @else
                {{-- Período NO activo - Mostrar mensaje de espera --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-center">
                        <div
                            class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 dark:bg-yellow-900 mb-4">
                            <svg class="h-8 w-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Aún no es momento de asignar
                        </h3>

                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            El período de planificación para
                            <strong>{{ Carbon\Carbon::create($year, $month, 1)->locale('es')->monthName }}
                                {{ $year }}</strong>
                            aún no está activo.
                        </p>

                        <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg inline-block">
                            <p class="text-blue-800 dark:text-blue-200">
                                <span class="font-semibold">📅 Período de planificación:</span>
                                <br>
                                <span class="text-lg">{{ $planningPeriod['start']->format('d/m/Y') }} -
                                    {{ $planningPeriod['end']->format('d/m/Y') }}</span>
                            </p>
                        </div>

                        <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                            Regresa durante el período indicado para realizar las asignaciones de home office.
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Flatpickr CSS y JS para el calendario --}}
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date');
            if (dateInput) {
                flatpickr(dateInput, {
                    locale: 'es',
                    dateFormat: 'Y-m-d',
                    minDate: '{{ now()->toDateString() }}',
                    maxDate: '{{ Carbon\Carbon::create($year, $month, 1)->endOfMonth()->toDateString() }}',
                    defaultDate: '{{ now()->toDateString() }}',
                    disableMobile: false,
                    theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
                    disable: [
                        function(date) {
                            // Deshabilitar fines de semana (0 = domingo, 6 = sábado)
                            return (date.getDay() === 0 || date.getDay() === 6);
                        }
                    ]
                });
            }
        });
    </script>
    @endpush
</x-app-layout>