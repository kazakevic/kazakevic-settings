# kazakevic-settings

![IMAGE ALT TEXT HERE](https://raw.githubusercontent.com/kazakevic/kazakevic-settings/master/depot/ss-new.png)

Simple feature toggle for Laravel Framework. 🚁

### Features
* simple UI
* simple resolving
* cached settings

Installation:

* `composer require kazakevic/settings`
* `php artisan migrate --seed`

* Settings menu can be accessed by this url: `office/settings`

How use setting?
 
* Create setting using `office/settings` menu.
* To get value just use facade: `use Kazakevic\Settings\Facades\Settings;` 
and get value `$value = Settings::get('is_new_feature_enabled');`
* Or just resolve `SettingsService` and get value:
```
public function indexAction(SettingsService $settings)
{
    dd($settings->get('is_new_feature_enabled'));
}
```

