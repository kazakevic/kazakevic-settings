# kazakevic-settings

![IMAGE ALT TEXT HERE](https://raw.githubusercontent.com/kazakevic/kazakevic-settings/master/depot/ss.png)

Simple feature toggle for Laravel Framework. 🚁

### Features
* simple UI
* simple resolving
* cached settings

Installation:

* `composer require kazakevic/settings`
* `php artisan migrate --seed`
* `php artisan vendor:publish` (and find  Kazakevic\Settings\SettingsServiceProvider)

* Settings menu can be accessed by this endpoind: `office/settings`

How to get setting value? Just resolve `SettingsService`
```   
public function indexAction(SettingsService $settings)
    {
        dd($settings->get('is_page_enabled'));
    }
