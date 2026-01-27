<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public function set($key, $value)
    {
        return Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function all()
    {
        return Setting::all()->pluck('value', 'key')->toArray();
    }
}
