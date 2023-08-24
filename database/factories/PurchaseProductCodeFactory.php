<?php

namespace Database\Factories;

use App\Enums\SaleType;
use App\Models\PurchaseProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseProductCode>
 */
class PurchaseProductCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_product_id' => PurchaseProduct::factory()->create(),
            'code' => random_int(1000000000, 9999999999),
            'sale_type' => $this->faker->randomElement(SaleType::cases()),
        ];
    }
}
