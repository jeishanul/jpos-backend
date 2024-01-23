<?php

namespace Database\Factories;

use App\Enums\BarcodeSymbology;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Enums\TaxMethods;
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
            'type' => $this->faker->randomElement(ProductType::cases()),
            'model' => $this->faker->name,
            'barcode_symbology' => $this->faker->randomElement(BarcodeSymbology::cases()),
            'category_id' => $this->faker->randomElement($categoryIds),
            'tax_id' => $this->faker->randomElement($taxIds),
            'tax_method' => $this->faker->randomElement(TaxMethods::cases()),
            'brand_id' => $this->faker->randomElement($brandIds),
            'unit_id' => $this->faker->randomElement($unitIds),
            'price' => $this->faker->randomFloat(),
            'cost' => $this->faker->randomFloat(),
            'alert_quantity' => $this->faker->randomDigit(),
            'media_id' => Media::factory()->create(),
            'qty' => 0,
            'status' => $this->faker->randomElement(Status::cases())
        ];
    }
}
