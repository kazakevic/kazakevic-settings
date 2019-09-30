<?php

namespace Kazakevic\Settings\Facades;

use Illuminate\Support\Facades\Facade;
use Kazakevic\Settings\Services\SettingsService;

class Settings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SettingsService::class;
    }
}
