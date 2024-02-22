<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'petugas1',
            'email' => 'petugas1@gmail.com',
            'password' => Hash::make('12345678'),
            'nama_lengkap' => 'petugas1',
            'role' => 'petugas',
            'verifikasi' => 'sudah',
            'alamat' => 'japan',
        ]);

        // User::create([
        //     'username' => 'administrator1',
        //     'email' => 'administrator1@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'nama_lengkap' => 'administrator1',
        //     'role' => 'administrator',
        //     'verifikasi' => 'sudah',
        //     'alamat' => 'japan',
        // ]);
    }
}
