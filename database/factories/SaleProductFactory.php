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
        $purchaseProductCode = $this->faker->randomElement((new PurchaseProductCodeRepository)->query()->where('sale_type','Sale')->get());

        return [
            'sale_id' => Sale::factory()->create(),
            'purchase_product_code_id' => $purchaseProductCode->purchaseProduct->id,
            'price' => $this->faker->randomFloat(),
            'code' => $purchaseProductCode->code,
        ];
    }
}
