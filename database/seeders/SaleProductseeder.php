<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleProduct;
use App\Repositories\PurchaseProductCodeRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleProductseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseProductCodes = (new PurchaseProductCodeRepository)->query()->where('sale_type', 'Sale')->get();

        foreach ($purchaseProductCodes as $purchaseProductCode) {
            SaleProduct::create([
                'sale_id' => Sale::factory()->create(),
                'purchase_product_code_id' => $purchaseProductCode->purchaseProduct->id,
                'price' => fake()->randomFloat(),
                'code' => $purchaseProductCode->code,
            ]);
        }
    }
}
