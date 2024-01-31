<?php

use App\Models\Media;
use App\Models\Shop;
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
            $table->foreignId('shop_id')->constrained((new Shop())->getTable());
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->foreignId('supplier_id')->constrained((new User())->getTable());
            $table->foreignId('media_id')->nullable()->constrained((new Media())->getTable());
            $table->timestamp('date')->nullable();
            $table->string('reference_no');
            $table->double('order_discount')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->double('grand_total');
            $table->double('paid_amount')->nullable();
            $table->string('status');
            $table->string('payment_status');
            $table->string('payment_method');
            $table->longText('note')->nullable();
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
