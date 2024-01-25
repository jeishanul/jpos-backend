<?php

namespace App\Repositories;

use App\Http\Requests\SettingsRequest;
use App\Models\Settings;

class SettingsRepository extends Repository
{
    public static function model()
    {
        return Settings::class;
    }
    public static function updateByRequest(SettingsRequest $settingsRequest, Settings $settings): Settings
    {
        self::update($settings, []);

        return $settings;
    }
}
