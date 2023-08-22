<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Media;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'parent_id' => 1,
            'media_id' => Media::factory()->create(),
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
