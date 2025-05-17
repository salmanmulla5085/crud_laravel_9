<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run(): void
    {
        // Create 1 Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'address' => 'Admin Address',
            'is_active' => true,
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);

        // Create 30 Normal Users
        User::factory()->count(30)->create();
    }
}
