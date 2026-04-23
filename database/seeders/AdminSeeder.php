<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin utama
        User::updateOrCreate(
            ['email' => 'zerathin@admin.com'],
            [
                'name'              => 'zerathin',
                'password'          => Hash::make('zerathinloona'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Kasir contoh
        User::updateOrCreate(
            ['email' => 'beelzebub@kasir.com'],
            [
                'name'              => 'beelzebub',
                'password'          => Hash::make('beelzebub'),
                'role'              => 'kasir',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Akun Admin & Kasir berhasil dibuat!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin', 'zerathin@admin.com', 'zerathinloona'],
                ['Kasir', 'beelzebub@kasir.com', 'beelzebub'],
            ]
        );
    }
}