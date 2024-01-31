<?php

use App\Repositories\SettingsRepository;
use Carbon\Carbon;

function dateFormat($date)
{
    $settings = SettingsRepository::find(1);
    $formatDate = str_replace([',', '_'], [', ', ' '], Carbon::createFromTimeString($date)->timezone($settings->timezone)->format(str_replace(' ', $settings->date_separator->value, $settings->date_format->value)));
    return $formatDate;
}
function numberFormat($number)
{
    return number_format(round($number, 2), 2);
}
