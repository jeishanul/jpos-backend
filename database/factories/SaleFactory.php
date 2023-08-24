<?php

namespace Database\Factories;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = $this->faker->randomElement((new UserRepository)->query()->where('role','Admin')->get());
        $supplier = $this->faker->randomElement((new UserRepository)->query()->where('role','Customer')->get());

        return [
            'user_id' => $user->id,
            'supplier_id' => $supplier->id,
            'date' => $this->faker->date(),
            'invoice_no' => random_int(1000000000, 9999999999),
            'payable' => $this->faker->randomFloat(),
            'due' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'transportation_cost' => $this->faker->randomFloat(),
        ];
    }
}
