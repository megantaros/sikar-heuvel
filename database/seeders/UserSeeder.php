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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@123.com',
            'password' => Hash::make('admin123'),
            'phone_number' => '085702169158',
            'avatar' => '',
            'role' => 'admin',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
    }
}
