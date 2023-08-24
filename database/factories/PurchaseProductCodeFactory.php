<?php

namespace Database\Factories;

use App\Repositories\PurchaseProductRepository;
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
        $purchaseProduct = $this->faker->randomElement((new PurchaseProductRepository)->getAll());

        for ($i = 1; $i <= 5; $i++) {
            return [
                'purchase_product_id' => $purchaseProduct->id,
                'code' => random_int(1000000000, 9999999999),
            ];
        }

        
    }
}
