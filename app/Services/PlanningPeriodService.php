<?php

namespace App\Services;

use App\Models\SystemSetting;
use Carbon\Carbon;

class PlanningPeriodService
{
    // Estados del período
    const STATUS_BEFORE = 'before';      // Antes del período
    const STATUS_ACTIVE = 'active';      // Durante el período
    const STATUS_JUST_ENDED = 'just_ended'; // Terminó hace menos de 3 días
    const STATUS_ENDED = 'ended';        // Terminó hace más de 3 días

    /**
     * Obtener información del período de planificación para un mes específico
     * 
     * - Para Enero: planificación configurable desde el panel de admin
     * - Para otros meses: última semana del mes previo
     */
    public static function getPlanningPeriod(int $month, int $year): array
    {
        // Excepción para enero: planificación configurable
        if ($month === 1) {
            $startDay = SystemSetting::getInt('january_planning_start_day', 5);
            $endDay = SystemSetting::getInt('january_planning_end_day', 9);
            $planningStart = Carbon::create($year, 1, $startDay)->startOfDay();
            $planningEnd = Carbon::create($year, 1, $endDay)->endOfDay();
        } else {
            // Última semana del mes previo
            $prevMonth = Carbon::create($year, $month, 1)->subMonth();
            $lastDayPrevMonth = $prevMonth->copy()->endOfMonth();
            
            // Comenzar desde el lunes de la última semana del mes previo
            $planningStart = $lastDayPrevMonth->copy()->startOfWeek()->startOfDay();
            $planningEnd = $lastDayPrevMonth->copy()->endOfDay();
        }
        
        return [
            'start' => $planningStart,
            'end' => $planningEnd,
        ];
    }

    /**
     * Obtener el estado del período de planificación
     * 
     * @return string STATUS_BEFORE, STATUS_ACTIVE, STATUS_JUST_ENDED, o STATUS_ENDED
     */
    public static function getPeriodStatus(int $month, int $year): string
    {
        $now = Carbon::now();
        $period = self::getPlanningPeriod($month, $year);
        
        // Si estamos antes del período
        if ($now->lt($period['start'])) {
            return self::STATUS_BEFORE;
        }
        
        // Si estamos durante el período
        if ($now->between($period['start'], $period['end'])) {
            return self::STATUS_ACTIVE;
        }
        
        // Si ya pasó el período, verificar cuántos días han pasado
        $daysSinceEnd = $period['end']->diffInDays($now);
        
        if ($daysSinceEnd <= 3) {
            return self::STATUS_JUST_ENDED;
        }
        
        return self::STATUS_ENDED;
    }

    /**
     * Verificar si actualmente estamos en período de planificación para un mes específico
     */
    public static function isInPlanningPeriod(int $month, int $year): bool
    {
        return self::getPeriodStatus($month, $year) === self::STATUS_ACTIVE;
    }

    /**
     * Verificar si se puede planificar para un mes/año específico
     * Considera el período de planificación activo
     */
    public static function canPlanForMonth(int $month, int $year): bool
    {
        return self::isInPlanningPeriod($month, $year);
    }

    /**
     * Verificar si se puede planificar para una fecha específica (home office)
     * La fecha debe estar en un mes cuyo período de planificación esté activo
     */
    public static function canPlanForDate(Carbon $date): bool
    {
        return self::isInPlanningPeriod($date->month, $date->year);
    }

    /**
     * Obtener el mensaje descriptivo del período de planificación
     */
    public static function getPlanningPeriodMessage(int $month, int $year): string
    {
        $period = self::getPlanningPeriod($month, $year);
        $status = self::getPeriodStatus($month, $year);
        
        $monthName = Carbon::create($year, $month, 1)->locale('es')->monthName;
        
        switch ($status) {
            case self::STATUS_ACTIVE:
                return "✅ Período de planificación ACTIVO para {$monthName}: del {$period['start']->format('d/m')} al {$period['end']->format('d/m')}";
            
            case self::STATUS_JUST_ENDED:
                return "⛔ El período de planificación para {$monthName} ya finalizó el {$period['end']->format('d/m/Y')}";
            
            case self::STATUS_BEFORE:
                return "⏰ El período de planificación para {$monthName} será del {$period['start']->format('d/m')} al {$period['end']->format('d/m')}";
            
            default: // STATUS_ENDED
                return "⏰ El período de planificación para {$monthName} es del {$period['start']->format('d/m')} al {$period['end']->format('d/m')}";
        }
    }

    /**
     * Obtener información completa del período para las vistas
     */
    public static function getPlanningPeriodInfo(int $month, int $year): array
    {
        $period = self::getPlanningPeriod($month, $year);
        $status = self::getPeriodStatus($month, $year);
        $isActive = $status === self::STATUS_ACTIVE;
        
        return [
            'start' => $period['start'],
            'end' => $period['end'],
            'isActive' => $isActive,
            'status' => $status,
            'message' => self::getPlanningPeriodMessage($month, $year),
            'canPlan' => $isActive,
        ];
    }
}
