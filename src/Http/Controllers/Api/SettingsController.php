<?php

namespace Kazakevic\Settings\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kazakevic\Settings\Models\Setting;
use Kazakevic\Settings\Repository\SettingsRepository;
use Kazakevic\Settings\Services\SettingsService;
use Symfony\Component\Yaml\Yaml;

class SettingsController extends Controller
{
    private const LIMIT = 10;

    public function index(SettingsRepository $settingsRepository): JsonResponse
    {
        $settings = $settingsRepository->get(self::LIMIT);

        foreach ($settings as $setting) {
            switch ($setting->type) {
                case Setting::BOOL:
                    $setting->value = (bool) $setting->value;
                    break;
                case Setting::INT:
                    $setting->value = (int) $setting->value;
                    break;
                case Setting::OBJECT:
                    $setting->value = Yaml::parse($setting->value);
                    break;
            }
            $setting->type = (int) $setting->type;
        }
        return new JsonResponse($settings ?? []);
    }

    /**
     * @param SettingsRepository $settingsRepository
     * @param int $id
     * @return JsonResponse
     */
    public function show(SettingsRepository $settingsRepository, int $id): JsonResponse
    {
        $setting = $settingsRepository->findById($id);

        switch ($setting->type) {
            case Setting::BOOL:
                $setting->value = (bool) $setting->value;
                break;
            case Setting::INT:
                $setting->value = (int) $setting->value;
                break;
        }
        $setting->type = (int) $setting->type;

        return new JsonResponse($setting);
    }

    public function store(Request $request): JsonResponse
    {
        $setting = Setting::create($request->all());
        return new JsonResponse($setting);
    }

    public function update(Request $request, SettingsService $settings, int $id): JsonResponse
    {
        $setting = Setting::findOrFail($id);
        $setting->update($request->all());
        $settings->clearSettingCacheById($id);
        return new JsonResponse($setting);
    }

    public function destroy(SettingsService $settings, int $id): JsonResponse
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        $settings->clearSettingCacheById($id);
        return new JsonResponse('');
    }

    public function search(SettingsRepository $settingsRepository, string $query = '')
    {
        $results = [];
        if ($query) {
            $results = $settingsRepository->findByQuery($query);
        }
        return new JsonResponse($results);
    }
}
