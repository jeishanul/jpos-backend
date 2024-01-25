<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencys = [
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'status' => Status::ACTIVE->value
            ],
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'status' => Status::ACTIVE->value
            ],
            [
                'shop_id' => 1,
                'created_by' => 2,
                'name' => 'Taka',
                'code' => 'BDT',
                'symbol' => '৳',
                'status' => Status::ACTIVE->value
            ]
        ];
        
        Currency::insert($currencys);
    }
}
