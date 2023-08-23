<?php

namespace Database\Factories;

use App\Enums\DiscountType;
use App\Enums\Status;
use App\Models\Media;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TaxRepository;
use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = $this->faker->randomElement((new UserRepository)->getAll());
        $category = $this->faker->randomElement((new CategoryRepository)->getAll());
        $tax = $this->faker->randomElement((new TaxRepository)->getAll());
        $brand = $this->faker->randomElement((new BrandRepository)->getAll());
        $unit = $this->faker->randomElement((new UnitRepository)->getAll());

        return [
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'code' => random_int(1000000000, 9999999999),
            'model' => $this->faker->name,
            'category_id' => $category->id,
            'tax_id' => $tax->id,
            'brand_id' => $brand->id,
            'unit_id' => $unit->id,
            'price' => $this->faker->randomFloat(),
            'alert_qty' => $this->faker->randomDigit(),
            'discount' => $this->faker->randomDigit(),
            'discount_type' => $this->faker->randomElement(DiscountType::cases()),
            'status' => $this->faker->randomElement(Status::cases()),
            'media_id' => Media::factory()->create(),
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
