<?php

namespace Database\Factories;

use App\Enums\PurchaseStatus;
use App\Models\Media;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = $this->faker->randomElement((new UserRepository)->query()->where('role','Admin')->get());
        $supplier = $this->faker->randomElement((new UserRepository)->query()->where('role','Supplier')->get());

        return [
            'user_id' => $user->id,
            'supplier_id' => $supplier->id,
            'media_id' => Media::factory()->create(),
            'date' => $this->faker->date(),
            'batch_no' => random_int(1000000000, 9999999999),
            'invoice_no' => random_int(1000000000, 9999999999),
            'payable' => $this->faker->randomFloat(),
            'due' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'purchase_status' => $this->faker->randomElement(PurchaseStatus::cases()),
        ];
    }
}
