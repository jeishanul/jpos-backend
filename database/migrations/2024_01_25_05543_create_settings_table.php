<?php

use App\Models\Currency;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->nullable()->constrained((new Shop())->getTable());
            $table->foreignId('user_id')->nullable()->constrained((new User())->getTable());
            $table->foreignId('logo')->nullable()->constrained((new Media())->getTable());
            $table->foreignId('favicon')->nullable()->constrained((new Media())->getTable());
            $table->foreignId('small_logo')->nullable()->constrained((new Media())->getTable());
            $table->foreignId('currency_id')->constrained((new Currency())->getTable());
            $table->string('system_name');
            $table->string('currency_position');
            $table->string('date_format');
            $table->string('date_separator');
            $table->string('developed_by');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
