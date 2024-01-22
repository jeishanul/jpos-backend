<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
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
            'rate' => $this->faker->randomElement([10, 15, 20]),
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
