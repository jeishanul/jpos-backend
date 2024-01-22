<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\ShopCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopCategory::create([
            'user_id' => 1,
            'name' => 'All In One',
            'description' => fake()->text(200),
            'status' => Status::ACTIVE->value
        ]);
    }
}
