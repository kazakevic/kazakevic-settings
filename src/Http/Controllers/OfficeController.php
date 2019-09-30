<?php

namespace Kazakevic\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class OfficeController extends Controller
{
    public function settingsAction()
    {
        Artisan::call('vendor:publish', [
            '--tag' => 'public',
            '--force' => 1
        ]);
        return view('settings::office.settings');
    }
}
