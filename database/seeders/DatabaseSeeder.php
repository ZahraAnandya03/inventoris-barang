<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'user_id' => '1',
            'user_nama' => 'Super User',
            'user_pass' => Hash::make('password'),
            'user_hak' => 'SU',
            'user_sts' => '1',
        ]);
        User::create([
            'user_id' => '2',
            'user_nama' => 'Admin',
            'user_pass' => Hash::make('password'),
            'user_hak' => 'ad',
            'user_sts' => '1',
        ]);
    }
}
