<?php

namespace App\Repositories;

use App\Http\Requests\SettingsRequest;
use App\Models\Settings;

class SettingsRepository extends Repository
{
    private static $path = '/settings';
    public static function model()
    {
        return Settings::class;
    }
    public static function updateByRequest(SettingsRequest $settingsRequest, Settings $settings): Settings
    {
        $logoId = null;
        if ($settingsRequest->hasFile('logo')) {
            $logo = (new MediaRepository())->updateOrCreateByRequest(
                $settingsRequest->logo,
                self::$path,
                'Image'
            );
            $logoId = $logo->id;
        }

        $smallLogoId = null;
        if ($settingsRequest->hasFile('small_logo')) {
            $smallLogo = (new MediaRepository())->updateOrCreateByRequest(
                $settingsRequest->small_logo,
                self::$path,
                'Image'
            );
            $smallLogoId = $smallLogo->id;
        }

        $faviconId = null;
        if ($settingsRequest->hasFile('favicon')) {
            $favicon = (new MediaRepository())->updateOrCreateByRequest(
                $settingsRequest->favicon,
                self::$path,
                'Image'
            );
            $faviconId = $favicon->id;
        }

        self::update($settings, [
            'system_name' => $settingsRequest->system_name,
            'logo' => $logoId,
            'favicon' => $faviconId,
            'small_logo' => $smallLogoId,
            'developed_by' => $settingsRequest->developed_by,
            'currency_position' => $settingsRequest->currency_position,
            'date_format' => $settingsRequest->date_format,
            'date_separator' => $settingsRequest->date_separator,
            'phone_number' => $settingsRequest->phone_number,
            'email' => $settingsRequest->email,
            'address' => $settingsRequest->address,
            'currency_id' => $settingsRequest->currency_id
        ]);

        return $settings;
    }
}
