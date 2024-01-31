<?php

namespace Database\Seeders;

use App\Enums\CurrencyPosition;
use App\Enums\DateFormat;
use App\Enums\DateSeparator;
use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'shop_id' => 1,
            'user_id' => 2,
            'system_name' => 'JPOS',
            'developed_by' => 'JPOS',
            'currency_position' => CurrencyPosition::PREFIX->value,
            'date_format' => DateFormat::DMY->value,
            'date_separator' => DateSeparator::SLASH->value,
            'timezone' => 'Asia/Dhaka',
            'phone_number' => '017123456789',
            'email' => 'jpos@gmail.com',
            'address' => 'JPOS',
            'currency_id' => 1
        ]);
    }
}
