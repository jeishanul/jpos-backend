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
            $table->foreignId('user_id')->nullable()->constrained((new User())->getTable());
            $table->foreignId('shop_id')->nullable()->constrained((new Shop())->getTable());
            $table->foreignId('supplier_id')->nullable()->constrained((new User())->getTable());
            $table->foreignId('media_id')->nullable()->constrained((new Media())->getTable()); // attachment
            $table->timestamp('date');
            $table->string('batch_no');
            $table->string('invoice_no');
            $table->double('payable')->default(0);
            $table->double('due')->default(0);
            $table->double('discount')->default(0);
            $table->double('total')->default(0);
            $table->double('transportation_cost')->default(0);
            $table->string('purchase_status');
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
