<?php

namespace Kazakevic\Settings\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Kazakevic\Settings\Models\Setting;
use Symfony\Component\Yaml\Yaml;

class SettingsService
{
    private const SETTINGS_TTL = 60 * 60 * 24 * 7;

    public static function getSettingCacheKey(string $key): string
    {
        return 'settings_' . gzcompress(base64_encode($key));
    }

    /**
     * @param  string $key
     * @return mixed
     */
    public function get(string $key)
    {
        $namespace = self::getSettingCacheKey($key);
        $value = Cache::remember($namespace, self::SETTINGS_TTL, function () use ($key) {
            try {
                $option = Setting::where('key', $key)->firstOrFail();
            } catch (ModelNotFoundException $exception) {
                return null;
            }
            return $this->valueResolver($option);
        });

        return $value;
    }

    /**
     * @param string $key
     */
    public function clearSettingCacheByKey(string $key)
    {
        $namespace = self::getSettingCacheKey($key);
        Cache::forget($namespace);
    }

    /**
     * @param int $id
     */
    public function clearSettingCacheById(int $id)
    {
        $option = Setting::find($id);
        self::clearSettingCacheByKey($option->key);
    }

    /**
     * @param Setting $option
     * @return mixed
     */
    private function valueResolver(Setting $option)
    {
        switch ($option->type) {
            case Setting::BOOL:
                $option->value = (bool) $option->value;
                break;
            case Setting::INT:
                $option->value = (int) $option->value;
                break;
            case Setting::OBJECT:
                $option->value = Yaml::parse($option->value);
                break;
        }
        return $option->value;
    }
}
