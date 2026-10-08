<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['Admin Toko',  'admin@example.com',  'admin'],
            ['Editor Toko', 'editor@example.com', 'editor'],
            ['User Biasa',  'user@example.com',   'user'],
        ];

        foreach ($accounts as [$name, $email, $role]) {
            $user = new User([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password123'),
            ]);
            // role & verifikasi di-set lewat forceFill (karena tidak ada di $fillable)
            $user->forceFill(['role' => $role, 'email_verified_at' => now()])->save();
        }
    }
}
