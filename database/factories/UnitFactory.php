<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
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
            'code' => $this->faker->name,
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
