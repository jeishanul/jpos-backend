<?php

namespace Database\Factories;

use App\Repositories\ProductRepository;
use App\Repositories\PurchaseRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseProduct>
 */
class PurchaseProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchase = $this->faker->randomElement((new PurchaseRepository)->getAll());
        $product = $this->faker->randomElement((new ProductRepository)->getAll());

        $codes = [];
        for ($i = 1; $i <= 5; $i++) {
            $codes[] = random_int(1000000000, 9999999999);
        }

        return [
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
            'price' => $this->faker->randomFloat(),
            'code' => json_encode($codes),
        ];
    }
}
