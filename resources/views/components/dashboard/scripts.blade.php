@props(['homeOfficeByDate', 'flexibleByArea'])

<script>
    // Paleta de colores para horarios (se asignan dinámicamente)
    const _timeColorPalette = [
        { bg: 'bg-green-50 dark:bg-green-900/30', dot: 'bg-green-500', badge: 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' },
        { bg: 'bg-yellow-50 dark:bg-yellow-900/30', dot: 'bg-yellow-500', badge: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200' },
        { bg: 'bg-blue-50 dark:bg-blue-900/30', dot: 'bg-blue-500', badge: 'bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200' },
        { bg: 'bg-purple-50 dark:bg-purple-900/30', dot: 'bg-purple-500', badge: 'bg-purple-100 text-purple-700 dark:bg-purple-800 dark:text-purple-200' },
        { bg: 'bg-rose-50 dark:bg-rose-900/30', dot: 'bg-rose-500', badge: 'bg-rose-100 text-rose-700 dark:bg-rose-800 dark:text-rose-200' },
        { bg: 'bg-teal-50 dark:bg-teal-900/30', dot: 'bg-teal-500', badge: 'bg-teal-100 text-teal-700 dark:bg-teal-800 dark:text-teal-200' },
        { bg: 'bg-orange-50 dark:bg-orange-900/30', dot: 'bg-orange-500', badge: 'bg-orange-100 text-orange-700 dark:bg-orange-800 dark:text-orange-200' },
        { bg: 'bg-cyan-50 dark:bg-cyan-900/30', dot: 'bg-cyan-500', badge: 'bg-cyan-100 text-cyan-700 dark:bg-cyan-800 dark:text-cyan-200' },
        { bg: 'bg-indigo-50 dark:bg-indigo-900/30', dot: 'bg-indigo-500', badge: 'bg-indigo-100 text-indigo-700 dark:bg-indigo-800 dark:text-indigo-200' },
        { bg: 'bg-pink-50 dark:bg-pink-900/30', dot: 'bg-pink-500', badge: 'bg-pink-100 text-pink-700 dark:bg-pink-800 dark:text-pink-200' },
    ];
    const _timeColorMap = {};

    function getTimeColor(time) {
        return _timeColorMap[time] || _timeColorPalette[0];
    }

    // Datos de Home Office
    const assignmentsByDate = @json($homeOfficeByDate);

    // Datos de Horarios Flexibles por área
    const flexibleByArea = @json($flexibleByArea);

    // Inicializar mapa de colores por horario
    (function() {
        const allTimes = new Set();
        Object.values(flexibleByArea || {}).forEach(arr => arr.forEach(a => allTimes.add(a.time)));
        [...allTimes].sort().forEach((time, i) => {
            _timeColorMap[time] = _timeColorPalette[i % _timeColorPalette.length];
        });
    })();

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
                        <p class="font-medium text-gray-800 dark:text-gray-200">${a.name + ' ' + a.last_name}</p>
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
    function openFlexibleModal(area, time) {
        const modal = document.getElementById('flexibleModal');
        const title = document.getElementById('flexibleModalTitle');
        const content = document.getElementById('flexibleModalContent');

        title.innerHTML = '⏰ ' + area + ' — ' + time;

        const key = area + '::' + time;
        const assignments = flexibleByArea[key] || [];

        if (assignments.length > 0) {
            content.innerHTML = assignments.map(a => {
                const colors = getTimeColor(a.time);

                return `
                    <div class="flex items-center justify-between p-3 ${colors.bg} rounded-lg">
                        <div class="flex items-center">
                            <div class="w-2 h-2 ${colors.dot} rounded-full mr-3"></div>
                            <p class="font-medium text-gray-800 dark:text-gray-200">${a.name + ' ' + a.last_name}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-xs font-semibold ${colors.badge}">${a.time}</span>
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

    // Función para filtrar calendario de Home Office por nombre
    function filterHomeOffice(searchTerm) {
        searchTerm = searchTerm.toLowerCase().trim();
        const calendarDays = document.querySelectorAll('.calendar-day');

        calendarDays.forEach(day => {
            const dateKey = day.dataset.date;
            const assignments = assignmentsByDate[dateKey] || [];

            if (searchTerm === '') {
                // Sin filtro, mostrar todos
                day.classList.remove('opacity-30', 'ring-2', 'ring-yellow-400');
            } else {
                // Verificar si alguna persona coincide con el término de búsqueda
                const hasMatch = assignments.some(a =>
                    (a.name + ' ' + a.last_name).toLowerCase().includes(searchTerm)
                );

                if (hasMatch) {
                    day.classList.remove('opacity-30');
                    day.classList.add('ring-2', 'ring-yellow-400');
                } else {
                    day.classList.add('opacity-30');
                    day.classList.remove('ring-2', 'ring-yellow-400');
                }
            }
        });
    }

    // Función para filtrar Horarios Flexibles por nombre
    function filterFlexible(searchTerm) {
        searchTerm = searchTerm.toLowerCase().trim();
        const areaCards = document.querySelectorAll('.flexible-area');

        areaCards.forEach(card => {
            const names = card.querySelectorAll('p');
            let hasMatch = false;

            if (searchTerm === '') {
                card.style.display = '';
                card.classList.remove('ring-2', 'ring-yellow-400');
                return;
            }

            names.forEach(p => {
                if (p.textContent.toLowerCase().trim().includes(searchTerm)) {
           hasMatch = true;
                }
            });

            if (hasMatch) {
                card.style.display = '';
                card.classList.add('ring-2', 'ring-yellow-400');
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>