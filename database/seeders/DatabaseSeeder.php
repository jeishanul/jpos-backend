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
            CategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            TaxSeeder::class,
            ProductSeeder::class,
            PurchaseProductCodeSeeder::class,
            // PurchaseProductSeeder::class,
        ]);

        $this->installStorageLink();
    }

    private function installStorageLink()
    {
        $this->command->warn('Installing storage link');
        Artisan::call('storage:link');
        $this->command->info('Storage link installed');
    }
}
