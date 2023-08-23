<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Repositories\UserRepository;
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
        $user = $this->faker->randomElement((new UserRepository)->getAll());

        return [
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'rate' => $this->faker->randomElement([10, 15, 20]),
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
