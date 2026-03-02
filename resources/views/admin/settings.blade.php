<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <x-icons.settings class="w-6 h-6 mr-2" /> {{ __('Configuración del Sistema') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Mensajes de éxito/error --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="mb-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 px-4 py-3 rounded">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Formulario de configuración --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                        <x-icons.settings class="w-5 h-5 mr-2" /> Parámetros del Sistema
                    </h3>
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Días de Home Office por mes --}}
                            <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                                <label for="max_home_office_days" class="block text-sm font-medium text-blue-800 dark:text-blue-200 mb-2 flex items-center">
                                    <x-icons.home-office class="w-5 h-5 mr-2" /> Días Home Office por Mes
                                </label>
                                <input type="number" 
                                       name="max_home_office_days" 
                                       id="max_home_office_days" 
                                       value="{{ old('max_home_office_days', $settings['max_home_office_days']) }}"
                                       min="1" 
                                       max="30"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center">
                                <p class="mt-2 text-xs text-blue-600 dark:text-blue-300">
                                    Número máximo de días de home office que puede tener cada empleado por mes.
                                </p>
                            </div>

                            {{-- Personas máximas por día --}}
                            <div class="bg-purple-50 dark:bg-purple-900 p-4 rounded-lg">
                                <label for="max_people_per_day" class="block text-sm font-medium text-purple-800 dark:text-purple-200 mb-2 flex items-center">
                                    <x-icons.users class="w-5 h-5 mr-2" /> Personas Máximas por Día
                                </label>
                                <input type="number" 
                                       name="max_people_per_day" 
                                       id="max_people_per_day" 
                                       value="{{ old('max_people_per_day', $settings['max_people_per_day']) }}"
                                       min="1" 
                                       max="100"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center">
                                <p class="mt-2 text-xs text-purple-600 dark:text-purple-300">
                                    Límite de personas que pueden estar en home office el mismo día.
                                </p>
                            </div>

                            {{-- Minutos de trabajo por día --}}
                            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                <label for="daily_work_minutes" class="block text-sm font-medium text-green-800 dark:text-green-200 mb-2 flex items-center">
                                    <x-icons.time class="w-5 h-5 mr-2" /> Minutos de Trabajo por Día
                                </label>
                                <input type="number" 
                                       name="daily_work_minutes" 
                                       id="daily_work_minutes" 
                                       value="{{ old('daily_work_minutes', $settings['daily_work_minutes']) }}"
                                       min="60" 
                                       max="1440"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center">
                                <p class="mt-2 text-xs text-green-600 dark:text-green-300">
                                    Minutos de trabajo diario (576 min = 9.6 horas).
                                </p>
                                <p class="mt-1 text-xs text-green-700 dark:text-green-400 font-semibold">
                                    = {{ number_format($settings['daily_work_minutes'] / 60, 1) }} horas
                                </p>
                            </div>
                        </div>

                        {{-- Período de Planificación de Enero --}}
                        <div class="mt-6 p-4 bg-orange-50 dark:bg-orange-900 rounded-lg">
                            <h4 class="text-md font-semibold text-orange-800 dark:text-orange-200 mb-4 flex items-center">
                                <x-icons.calendar class="w-5 h-5 mr-2" /> Período de Planificación para Enero
                            </h4>
                            <p class="text-sm text-orange-600 dark:text-orange-300 mb-4">
                                Configura los días del mes de enero en los que los empleados pueden planificar sus asignaciones.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Día de inicio --}}
                                <div>
                                    <label for="january_planning_start_day" class="block text-sm font-medium text-orange-800 dark:text-orange-200 mb-2 flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div> Día de Inicio
                                    </label>
                                    <input type="number" 
                                           name="january_planning_start_day" 
                                           id="january_planning_start_day" 
                                           value="{{ old('january_planning_start_day', $settings['january_planning_start_day']) }}"
                                           min="1" 
                                           max="31"
                                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center">
                                    <p class="mt-2 text-xs text-orange-600 dark:text-orange-300">
                                        Día del mes de enero donde inicia el período.
                                    </p>
                                </div>

                                {{-- Día de fin --}}
                                <div>
                                    <label for="january_planning_end_day" class="block text-sm font-medium text-orange-800 dark:text-orange-200 mb-2 flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div> Día de Fin
                                    </label>
                                    <input type="number" 
                                           name="january_planning_end_day" 
                                           id="january_planning_end_day" 
                                           value="{{ old('january_planning_end_day', $settings['january_planning_end_day']) }}"
                                           min="1" 
                                           max="31"
                                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center">
                                    <p class="mt-2 text-xs text-orange-600 dark:text-orange-300">
                                        Día del mes de enero donde termina el período.
                                    </p>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-orange-700 dark:text-orange-400 font-semibold flex items-center">
                                <x-icons.info class="w-4 h-4 mr-1" /> Período actual: Del {{ str_pad($settings['january_planning_start_day'], 2, '0', STR_PAD_LEFT) }}/01 al {{ str_pad($settings['january_planning_end_day'], 2, '0', STR_PAD_LEFT) }}/01
                            </p>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-primary-button>
                                💾 Guardar Configuración
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Sección: Extensión del Período de Asignación --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <x-icons.calendar class="w-5 h-5 mr-2" /> Reapertura del Período de Asignación
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Permite reabrir el período de asignación por días adicionales cuando los jefes/managers no completaron las asignaciones de horarios flexibles y home office a tiempo.
                    </p>

                    {{-- Estado actual de extensión --}}
                    @if($extensionInfo && $extensionInfo['isActive'])
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 rounded-lg">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-green-800 dark:text-green-200 flex items-center">
                                        <x-icons.check class="w-5 h-5 mr-2" />
                                        🔄 Extensión ACTIVA
                                    </p>
                                    <p class="text-sm text-green-700 dark:text-green-300 mt-1 ml-7">
                                        Mes: <strong>{{ ucfirst(\Carbon\Carbon::create($extensionInfo['year'], $extensionInfo['month'], 1)->locale('es')->monthName) }} {{ $extensionInfo['year'] }}</strong>
                                    </p>
                                    <p class="text-sm text-green-700 dark:text-green-300 mt-1 ml-7">
                                        Vigente hasta: <strong>{{ $extensionInfo['deadline']->format('d/m/Y') }}</strong>
                                        ({{ $extensionInfo['daysRemaining'] }} día{{ $extensionInfo['daysRemaining'] !== 1 ? 's' : '' }} restante{{ $extensionInfo['daysRemaining'] !== 1 ? 's' : '' }})
                                    </p>
                                </div>
                                <form action="{{ route('admin.settings.revoke-extension') }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de cancelar la extensión? Los managers ya no podrán realizar asignaciones fuera del período regular.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <x-icons.delete class="w-4 h-4 mr-1" /> Cancelar Extensión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif($extensionInfo && !$extensionInfo['isActive'])
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <x-icons.info class="w-4 h-4 mr-2" />
                                La última extensión ({{ ucfirst(\Carbon\Carbon::create($extensionInfo['year'], $extensionInfo['month'], 1)->locale('es')->monthName) }} {{ $extensionInfo['year'] }}) expiró el {{ $extensionInfo['deadline']->format('d/m/Y') }}.
                            </p>
                        </div>
                    @else
                        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <x-icons.info class="w-4 h-4 mr-2" />
                                No hay extensiones activas actualmente. El período de asignación sigue su calendario regular.
                            </p>
                        </div>
                    @endif

                    {{-- Botón para abrir modal --}}
                    <button type="button" 
                            onclick="document.getElementById('extendPeriodModal').classList.remove('hidden')"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-icons.calendar class="w-4 h-4 mr-1" /> 
                        {{ ($extensionInfo && $extensionInfo['isActive']) ? 'Modificar Extensión' : 'Reabrir Período de Asignación' }}
                    </button>
                </div>
            </div>

            {{-- Modal: Reapertura del Período --}}
            <div id="extendPeriodModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    {{-- Fondo oscuro --}}
                    <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" 
                         onclick="document.getElementById('extendPeriodModal').classList.add('hidden')"></div>

                    {{-- Centrador --}}
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    {{-- Contenido del modal --}}
                    <div class="relative inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <form action="{{ route('admin.settings.extend-period') }}" method="POST">
                            @csrf
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 dark:bg-indigo-900 sm:mx-0 sm:h-10 sm:w-10">
                                        <x-icons.calendar class="h-6 w-6 text-indigo-600 dark:text-indigo-400" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                            Reabrir Período de Asignación
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                            Esto permitirá a los jefes/managers realizar asignaciones de horarios flexibles y home office por los días adicionales indicados.
                                        </p>

                                        <div class="mt-4 space-y-4">
                                            {{-- Selección de mes --}}
                                            <div>
                                                <label for="extension_month_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Mes a reabrir
                                                </label>
                                                <select name="extension_month_year" id="extension_month_year" 
                                                        onchange="updateExtensionFields(this)"
                                                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    @foreach($availableMonthsForExtension as $m)
                                                        <option value="{{ $m['month'] }}-{{ $m['year'] }}">{{ $m['label'] }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="extension_month" id="extension_month" value="{{ $availableMonthsForExtension[0]['month'] }}">
                                                <input type="hidden" name="extension_year" id="extension_year" value="{{ $availableMonthsForExtension[0]['year'] }}">
                                            </div>

                                            {{-- Días de extensión --}}
                                            <div>
                                                <label for="extension_days" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                    Número de días adicionales
                                                </label>
                                                <input type="number" 
                                                       name="extension_days" 
                                                       id="extension_days" 
                                                       value="3"
                                                       min="1" 
                                                       max="15"
                                                       class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg font-bold text-center"
                                                       oninput="updateDeadlinePreview()">
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Mínimo 1 día, máximo 15 días.</p>
                                            </div>

                                            {{-- Preview --}}
                                            <div class="p-3 bg-indigo-50 dark:bg-indigo-900 rounded-lg">
                                                <p class="text-sm text-indigo-800 dark:text-indigo-200">
                                                    <strong>Período extendido hasta:</strong>
                                                    <span id="deadlinePreview" class="font-bold"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    ✅ Reabrir Período
                                </button>
                                <button type="button" 
                                        onclick="document.getElementById('extendPeriodModal').classList.add('hidden')" 
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function updateExtensionFields(select) {
                    const parts = select.value.split('-');
                    document.getElementById('extension_month').value = parts[0];
                    document.getElementById('extension_year').value = parts[1];
                }

                function updateDeadlinePreview() {
                    const days = parseInt(document.getElementById('extension_days').value) || 0;
                    const deadline = new Date();
                    deadline.setDate(deadline.getDate() + days);
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    document.getElementById('deadlinePreview').textContent = deadline.toLocaleDateString('es-ES', options);
                }

                // Inicializar preview
                document.addEventListener('DOMContentLoaded', updateDeadlinePreview);
            </script>

            {{-- Información actual --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <x-icons.chart class="w-5 h-5 mr-2" /> Resumen de Configuración Actual
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Parámetro
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Valor
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Última Modificación
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Modificado Por
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($allSettings as $setting)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 flex items-center">
                                            @switch($setting->key)
                                                @case('max_home_office_days')
                                                    <x-icons.home-office class="w-4 h-4 mr-2" /> Días Home Office por Mes
                                                    @break
                                                @case('max_people_per_day')
                                                    <x-icons.users class="w-4 h-4 mr-2" /> Personas Máximas por Día
                                                    @break
                                                @case('daily_work_minutes')
                                                    <x-icons.time class="w-4 h-4 mr-2" /> Minutos de Trabajo por Día
                                                    @break
                                                @case('january_planning_start_day')
                                                    <x-icons.calendar class="w-4 h-4 mr-2" /> Inicio Planificación Enero
                                                    @break
                                                @case('january_planning_end_day')
                                                    <x-icons.calendar class="w-4 h-4 mr-2" /> Fin Planificación Enero
                                                    @break
                                                @default
                                                    {{ $setting->key }}
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full font-bold">
                                                {{ $setting->value }}
                                                @if($setting->key === 'daily_work_minutes')
                                                    <span class="text-xs font-normal">({{ number_format($setting->value / 60, 1) }}h)</span>
                                                @elseif($setting->key === 'january_planning_start_day' || $setting->key === 'january_planning_end_day')
                                                    <span class="text-xs font-normal">de enero</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $setting->updated_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $setting->updatedBy->name ?? 'Sistema' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Ayuda --}}
            <div class="bg-yellow-50 dark:bg-yellow-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2 flex items-center">
                    <x-icons.info class="w-5 h-5 mr-2" /> Ayuda
                </h3>
                <ul class="list-disc list-inside text-sm text-yellow-700 dark:text-yellow-300 space-y-1">
                    <li><strong>Días Home Office por Mes:</strong> Cada empleado puede solicitar hasta este número de días de trabajo remoto mensualmente.</li>
                    <li><strong>Personas Máximas por Día:</strong> Se bloquean nuevas asignaciones cuando se alcanza este límite en un día específico.</li>
                    <li><strong>Minutos de Trabajo por Día:</strong> Jornada laboral estándar en minutos. (Ejemplo: 480 min = 8 horas, 576 min = 9.6 horas)</li>
                    <li><strong>Período de Planificación de Enero:</strong> Define los días del mes de enero en los que los empleados pueden realizar sus planificaciones. Para el resto de los meses, el período es la última semana del mes anterior.</li>
                    <li><strong>Reapertura del Período:</strong> Permite reabrir el período de asignación por días adicionales cuando los jefes/managers no completaron las asignaciones a tiempo. La extensión aplica para todos los managers y se refleja tanto en Home Office como en Horario Flexible.</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
