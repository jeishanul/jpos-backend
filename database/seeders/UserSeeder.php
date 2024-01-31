<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->superAdmin();
        $this->admin();
        $this->customer();
        $this->supplier();
    }
    private function superAdmin()
    {
        User::factory()->create([
            'name' => 'Demo Super Admin',
            'email' => 'superadmin@demo.com',
            'role' => 'Super Admin'
        ]);
    }
    private function admin()
    {
        User::factory()->create([
            'name' => 'Demo Admin',
            'email' => 'admin@demo.com',
            'role' => 'Admin'
        ]);
    }
    private function customer()
    {
        User::factory()->create([
            'name' => 'Demo Customer',
            'email' => 'customer@demo.com',
            'role' => 'Customer',
            'user_id' => 2,
            'shop_id' => 1
        ]);
    }
    private function supplier()
    {
        User::factory()->create([
            'name' => 'Demo Supplier',
            'email' => 'supplier@demo.com',
            'role' => 'Supplier',
            'user_id' => 2,
            'shop_id' => 1
        ]);
    }
}
