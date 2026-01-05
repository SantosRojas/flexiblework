<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'updated_by',
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    public static function get(string $key, $default = null)
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function getInt(string $key, int $default = 0): int
    {
        return (int) static::get($key, $default);
    }

    public static function getFloat(string $key, float $default = 0.0): float
    {
        return (float) static::get($key, $default);
    }

    public static function set(string $key, $value, int $userId): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value, 'updated_by' => $userId]
        );
    }


}
