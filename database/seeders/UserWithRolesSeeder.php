<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (UserRole::cases() as $role) {
            User::create([
                'name' => ucfirst(str_replace('_', ' ', $role->value)),
                'username' => $role->value,
                'email' => $role->value . '@example.com',
                'password' => Hash::make('password'), // default password
                'role' => $role,
                'avatar' => null,
                'bio' => 'This is the ' . $role->value . ' user.',
                'active' => true,
                'banned' => false,
                'phone' => '0123456789',
                'country' => 'Country',
                'language' => 'en',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
