<?php

use App\Models\Media;
use App\Models\Shop;
use App\Models\Tax;
use App\Models\User;
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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->nullable()->constrained((new Shop())->getTable());
            $table->foreignId('user_id')->nullable()->constrained((new User())->getTable());
            $table->foreignId('supplier_id')->nullable()->constrained((new User())->getTable());
            $table->string('reference_no');
            $table->double('order_discount')->default(0);
            $table->double('shipping_cost')->default(0);
            $table->double('grand_total');
            $table->double('paid_amount')->default(0);
            $table->string('status');
            $table->string('payment_status');
            $table->string('payment_method');
            $table->foreignId('tax_id')->nullable()->constrained((new Tax())->getTable());
            $table->foreignId('document_id')->nullable()->constrained((new Media())->getTable());
            $table->longText('note')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
