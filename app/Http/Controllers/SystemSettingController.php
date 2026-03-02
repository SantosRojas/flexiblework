<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use App\Services\PlanningPeriodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SystemSettingController extends Controller
{
    /**
     * Mostrar el formulario de configuración del sistema
     */
    public function index()
    {
        $user = Auth::user();
        
        // Solo administradores pueden acceder
        if (!$user->isAdmin()) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }
        
        $settings = [
            'max_home_office_days' => SystemSetting::getInt('max_home_office_days', 2),
            'max_people_per_day' => SystemSetting::getInt('max_people_per_day', 7),
            'daily_work_minutes' => SystemSetting::getInt('daily_work_minutes', 576),
            'january_planning_start_day' => SystemSetting::getInt('january_planning_start_day', 5),
            'january_planning_end_day' => SystemSetting::getInt('january_planning_end_day', 9),
        ];
        
        // Obtener historial de cambios
        $allSettings = SystemSetting::with('updatedBy')->get();

        // Obtener información de extensión activa
        $extensionInfo = PlanningPeriodService::getCurrentExtensionInfo();

        // Calcular mes/año actuales para el formulario de extensión
        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $nextMonthObj = $now->copy()->addMonth();

        // Meses disponibles para extender (mes actual y próximo)
        $availableMonthsForExtension = [
            [
                'month' => $currentMonth,
                'year' => $currentYear,
                'label' => ucfirst(Carbon::create($currentYear, $currentMonth, 1)->locale('es')->monthName) . ' ' . $currentYear,
            ],
            [
                'month' => $nextMonthObj->month,
                'year' => $nextMonthObj->year,
                'label' => ucfirst(Carbon::create($nextMonthObj->year, $nextMonthObj->month, 1)->locale('es')->monthName) . ' ' . $nextMonthObj->year,
            ],
        ];
        
        return view('admin.settings', compact('settings', 'allSettings', 'extensionInfo', 'availableMonthsForExtension'));
    }

    /**
     * Actualizar la configuración del sistema
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Solo administradores pueden modificar
        if (!$user->isAdmin()) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
        
        $request->validate([
            'max_home_office_days' => 'required|integer|min:1|max:30',
            'max_people_per_day' => 'required|integer|min:1|max:100',
            'daily_work_minutes' => 'required|integer|min:60|max:1440',
            'january_planning_start_day' => 'required|integer|min:1|max:31',
            'january_planning_end_day' => 'required|integer|min:1|max:31|gte:january_planning_start_day',
        ], [
            'max_home_office_days.required' => 'El número de días de home office es requerido.',
            'max_home_office_days.min' => 'El mínimo de días debe ser 1.',
            'max_home_office_days.max' => 'El máximo de días debe ser 30.',
            'max_people_per_day.required' => 'El número de personas por día es requerido.',
            'max_people_per_day.min' => 'El mínimo de personas debe ser 1.',
            'max_people_per_day.max' => 'El máximo de personas debe ser 100.',
            'daily_work_minutes.required' => 'Los minutos de trabajo son requeridos.',
            'daily_work_minutes.min' => 'El mínimo de minutos debe ser 60 (1 hora).',
            'daily_work_minutes.max' => 'El máximo de minutos debe ser 1440 (24 horas).',
            'january_planning_start_day.required' => 'El día de inicio de planificación de enero es requerido.',
            'january_planning_start_day.min' => 'El día debe ser al menos 1.',
            'january_planning_start_day.max' => 'El día no puede ser mayor a 31.',
            'january_planning_end_day.required' => 'El día de fin de planificación de enero es requerido.',
            'january_planning_end_day.min' => 'El día debe ser al menos 1.',
            'january_planning_end_day.max' => 'El día no puede ser mayor a 31.',
            'january_planning_end_day.gte' => 'El día de fin debe ser mayor o igual al día de inicio.',
        ]);
        
        SystemSetting::set('max_home_office_days', $request->max_home_office_days, $user->id);
        SystemSetting::set('max_people_per_day', $request->max_people_per_day, $user->id);
        SystemSetting::set('daily_work_minutes', $request->daily_work_minutes, $user->id);
        SystemSetting::set('january_planning_start_day', $request->january_planning_start_day, $user->id);
        SystemSetting::set('january_planning_end_day', $request->january_planning_end_day, $user->id);
        
        return back()->with('success', 'Configuración actualizada correctamente.');
    }

    /**
     * Extender el período de planificación para un mes específico
     */
    public function extendPeriod(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
        
        $request->validate([
            'extension_days' => 'required|integer|min:1|max:15',
            'extension_month' => 'required|integer|min:1|max:12',
            'extension_year' => 'required|integer|min:2020|max:2099',
        ], [
            'extension_days.required' => 'El número de días es requerido.',
            'extension_days.min' => 'Debe ser al menos 1 día.',
            'extension_days.max' => 'El máximo es 15 días.',
            'extension_month.required' => 'El mes es requerido.',
            'extension_year.required' => 'El año es requerido.',
        ]);
        
        $month = (int) $request->extension_month;
        $year = (int) $request->extension_year;
        $days = (int) $request->extension_days;
        
        $result = PlanningPeriodService::extendPeriod($month, $year, $days, $user->id);
        
        $monthName = ucfirst(Carbon::create($year, $month, 1)->locale('es')->monthName);
        
        return back()->with('success', "✅ Período de asignación para {$monthName} {$year} reabierto por {$days} día(s). Activo hasta el {$result['deadline']->format('d/m/Y')}.");
    }

    /**
     * Revocar/cancelar la extensión del período de planificación
     */
    public function revokeExtension()
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
        
        PlanningPeriodService::revokeExtension($user->id);
        
        return back()->with('success', '⛔ Extensión del período de asignación cancelada correctamente.');
    }
}
