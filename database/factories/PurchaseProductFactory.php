<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Repositories\ProductRepository;
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
        $product = $this->faker->randomElement((new ProductRepository)->query()->where('status','Active')->get());
        
        return [
            'purchase_id' => Purchase::factory()->create(),
            'product_id' => $product->id,
            'price' => $this->faker->randomFloat(),
        ];
    }
}
