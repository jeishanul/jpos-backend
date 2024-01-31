<?php

namespace App\Repositories;

use App\Http\Requests\SettingsRequest;
use App\Models\Settings;

class SettingsRepository extends Repository
{
    private static $path = '/settings';
    /**
     * A description of the entire PHP function.
     *
     * @return Settings::class
     */
    public static function model()
    {
        return Settings::class;
    }
    /**
     * Update settings by request.
     *
     * @param SettingsRequest $settingsRequest Description
     * @param Settings $settings Description
     * @return Settings
     */
    public static function updateByRequest(SettingsRequest $settingsRequest, Settings $settings): Settings
    {
        $logoId = $settings->logo_id;
        if ($settingsRequest->hasFile('logo')) {
            $logo = (new MediaRepository())->updateOrCreateByRequest(
                $settingsRequest->logo,
                self::$path,
                'Image'
            );
            $logoId = $logo->id;
        }

        $smallLogoId = $settings->small_logo_id;
        if ($settingsRequest->hasFile('small_logo')) {
            $smallLogo = (new MediaRepository())->updateOrCreateByRequest(
                $settingsRequest->small_logo,
                self::$path,
                'Image'
            );
            $smallLogoId = $smallLogo->id;
        }

        $faviconId = $settings->favicon_id;
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
            'logo_id' => $logoId,
            'favicon_id' => $faviconId,
            'small_logo_id' => $smallLogoId,
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
