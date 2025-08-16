<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user001',
                'email' => 'user001@example.com',
                'password' => Hash::make('user001'),
            ],
            [
                'name' => 'user002',
                'email' => 'user002@example.com',
                'password' => Hash::make('user002'),
            ],
            [
                'name' => 'user003',
                'email' => 'user003@example.com',
                'password' => Hash::make('user003'),
            ],
        ]);
    }
}
