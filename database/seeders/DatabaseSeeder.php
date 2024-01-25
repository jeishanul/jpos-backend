<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ShopCategorySeeder::class,
            ShopSeeder::class,
            ShopUserSeeder::class,
            CurrencySeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            TaxSeeder::class,
            ProductSeeder::class,
        ]);

        $this->installLink();
    }

    private function installLink()
    {
        $this->command->warn('Installing passport client');
        Artisan::call('passport:install');
        Artisan::call('storage:link');
        $this->command->info('Passport client installed');
    }
}
