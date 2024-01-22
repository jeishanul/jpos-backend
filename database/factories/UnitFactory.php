<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shops = Shop::where('status', 'Active')->get();
        return [
            'user_id' => $this->faker->randomElement($shops)->user_id,
            'shop_id' => $this->faker->randomElement($shops)->id,
            'name' => $this->faker->name,
            'code' => $this->faker->name,
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
