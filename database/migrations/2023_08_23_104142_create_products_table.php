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
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->foreignId('shop_id')->constrained((new Shop())->getTable());
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->string('model')->nullable();
            $table->string('barcode_symbology');
            $table->foreignId('category_id')->constrained((new Category())->getTable());
            $table->foreignId('tax_id')->constrained((new Tax())->getTable());
            $table->foreignId('brand_id')->constrained((new Brand())->getTable());
            $table->foreignId('unit_id')->constrained((new Unit())->getTable());
            $table->foreignId('media_id')->constrained((new Media())->getTable());
            $table->double('price');
            $table->double('cost');
            $table->bigInteger('qty');
            $table->integer('alert_quantity');
            $table->string('status');
            $table->string('tax_method');
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
