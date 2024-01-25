<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Http\Resources\SettingsResource;
use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(SettingsRequest $settingsRequest)
    {
        $settings = SettingsRepository::find(1);
        $settings = SettingsRepository::updateByRequest($settingsRequest, $settings);
        return $this->json('Settings successfully updated', [
            'settings' => SettingsResource::make($settings),
        ]);
    }
}
