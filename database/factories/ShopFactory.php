<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::where(['role' => 'Admin', 'status' => 'Active'])->pluck('id')->toArray();
        $shopCategoryIds = ShopCategory::where('status', 'Active')->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($userIds),
            'shop_category_id' => $this->faker->randomElement($shopCategoryIds),
            'name' => $this->faker->word,
            'description' => $this->faker->text(200),
            'status' => $this->faker->randomElement(Status::cases()),
        ];
    }
}
