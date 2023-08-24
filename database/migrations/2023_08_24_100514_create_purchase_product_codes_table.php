<?php

use App\Models\PurchaseProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_product_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_product_id')->nullable()->constrained((new PurchaseProduct())->getTable());
            $table->string('sale_type');
            $table->longText('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_product_codes');
    }
};
