<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->foreignId('shop_id')->constrained((new Shop())->getTable());
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained((new Category())->getTable());
            $table->foreignId('media_id')->constrained((new Media())->getTable());
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
        Schema::dropIfExists('categories');
    }
};
