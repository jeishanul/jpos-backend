<?php

namespace Database\Factories;

use App\Enums\DiscountType;
use App\Enums\Status;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Tax;
use App\Models\Unit;
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
        $categoryIds = Category::where(['shop_id' => 1, 'status' => 'Active'])->get()->pluck('id')->toArray();
        $brandIds = Brand::where(['shop_id' => 1, 'status' => 'Active'])->get()->pluck('id')->toArray();
        $taxIds = Tax::where(['shop_id' => 1, 'status' => 'Active'])->get()->pluck('id')->toArray();
        $unitIds = Unit::where(['shop_id' => 1, 'status' => 'Active'])->get()->pluck('id')->toArray();
        return [
            'user_id' => 2,
            'shop_id' => 1,
            'name' => $this->faker->name,
            'code' => random_int(1000000000, 9999999999),
            'model' => $this->faker->name,
            'category_id' => $this->faker->randomElement($categoryIds),
            'tax_id' => $this->faker->randomElement($taxIds),
            'brand_id' => $this->faker->randomElement($brandIds),
            'unit_id' => $this->faker->randomElement($unitIds),
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
