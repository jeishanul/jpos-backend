<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::create([
            'user_id' => 1,
            'shop_category_id' => 1,
            'name' => 'All In One Shop',
            'description' => fake()->text(200),
            'status' => Status::ACTIVE->value,
        ]);
    }
}
