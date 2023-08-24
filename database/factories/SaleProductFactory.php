<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Repositories\PurchaseProductCodeRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleProduct>
 */
class SaleProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchaseProductCode = $this->faker->randomElement((new PurchaseProductCodeRepository)->getAll());
        
        return [
            'sale_id' => Sale::factory()->create(),
            'product_id' => $purchaseProductCode->product->id,
            'price' => $this->faker->randomFloat(),
            'code' => $purchaseProductCode->code,
        ];
    }
}
