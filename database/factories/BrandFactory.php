<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Media;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'media_id' => Media::factory()->create(),
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
