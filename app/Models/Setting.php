<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'value_en', 'value_ja', 'type', 'group', 'label', 'sort_order'];

    /**
     * Get a setting value by key, with an optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, mixed $value, mixed $valueEn = null, mixed $valueJa = null): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'value_en' => $valueEn, 'value_ja' => $valueJa]);
    }

    /**
     * Get all settings for a specific group as key-value pairs.
     */
    public static function getGroup(string $group): array
    {
        $settings = static::where('group', $group)
            ->orderBy('sort_order')
            ->get();

        $result = [];
        foreach ($settings as $setting) {
            $result[$setting->key] = $setting->value;
            $result[$setting->key . '_en'] = $setting->value_en;
            $result[$setting->key . '_ja'] = $setting->value_ja;
        }
        return $result;
    }

    /**
     * Get all settings organized by group.
     */
    public static function allGrouped(): array
    {
        return static::orderBy('sort_order')
            ->get()
            ->groupBy('group')
            ->toArray();
    }
}
