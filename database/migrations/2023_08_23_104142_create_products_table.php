<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Shop;
use App\Models\Tax;
use App\Models\Unit;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained((new User())->getTable());
            $table->foreignId('shop_id')->nullable()->constrained((new Shop())->getTable());
            $table->string('name');
            $table->string('code');
            $table->string('model')->nullable();
            $table->foreignId('category_id')->constrained((new Category())->getTable());
            $table->foreignId('tax_id')->nullable()->constrained((new Tax())->getTable());
            $table->foreignId('brand_id')->nullable()->constrained((new Brand())->getTable());
            $table->foreignId('unit_id')->nullable()->constrained((new Unit())->getTable());
            $table->foreignId('media_id')->nullable()->constrained((new Media())->getTable());
            $table->double('price');
            $table->integer('alert_qty');
            $table->double('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
