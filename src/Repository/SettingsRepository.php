<?php

namespace Kazakevic\Settings\Repository;

use Kazakevic\Settings\Models\Setting;

class SettingsRepository
{
    public function get(int $limit = 10)
    {
        return Setting::paginate($limit);
    }

    public function findById(int $id)
    {
        return Setting::findOrFail($id);
    }

    public function findByQuery(string $query)
    {
        $result = [];
        $settings = Setting::where('key', 'like', '%' . $query . '%')->get();
        if (!empty($settings)) {
            $result = $settings;
        }
        return $settings;
    }
}
