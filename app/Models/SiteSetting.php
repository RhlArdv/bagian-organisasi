<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key_name',
        'group',
        'value',
        'description',
    ];

    /**
     * Ambil value berdasarkan key.
     */
    public static function getValue(string $key, $default = null): mixed
    {
        $setting = static::where('key_name', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set value berdasarkan key.
     */
    public static function setValue(string $key, string $value, ?string $group = null): void
    {
        static::updateOrCreate(
            ['key_name' => $key],
            array_filter([
                'value' => $value,
                'group' => $group,
            ])
        );
    }

    /**
     * Ambil semua settings berdasarkan group.
     */
    public static function getByGroup(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key_name')
            ->toArray();
    }
}
