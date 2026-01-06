<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlexibleScheduleAssignment extends Model
{
    protected $guarded = [
        'id'
    ];

    /**
     * Horarios de entrada predefinidos (sugerencias)
     */
    public const ALLOWED_START_TIMES = [
        '08:00',
        '08:30',
        '09:00',
    ];

    /**
     * Obtener la hora de inicio formateada
     */
    public function getStartTimeFormattedAttribute(): string
    {
        return substr($this->start_time, 0, 5);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Scope para filtrar por mes y año
     */
    public function scopeForMonth($query, int $month, int $year)
    {
        return $query->where('month', $month)
                     ->where('year', $year);
    }
}
