<?php

namespace Database\Seeders;

use App\Models\PurchaseProductCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseProductCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseProductCode::factory(50)->create();
    }
}
