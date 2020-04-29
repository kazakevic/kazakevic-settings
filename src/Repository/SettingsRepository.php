<?php

namespace Kazakevic\Settings\Repository;

use Illuminate\Http\Request;
use Kazakevic\Settings\Models\Setting;

class SettingsRepository
{
    public function get(Request $request, int $limit = 10)
    {
        $result = Setting::paginate($limit);
        if ($request->has('q')) {
            $result = $this->findByQuery($request->get('q'))->paginate($limit);
        }
        return $result;
    }

    public function findById(int $id)
    {
        return Setting::findOrFail($id);
    }

    public function findByQuery(string $query)
    {
        return Setting::where('key', 'like', '%' . $query . '%');
    }
}
