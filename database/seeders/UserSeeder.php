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
            'name' => "Fatemah",
            'full_name' => "Fatemah Kheder",
            'role'=>'client',
            'image' => "/users/default.jpeg",
            'email' => 'fatemah.kheder.1995@gmail.com',
            'password' =>Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => "Admin",
            'full_name' => "Admin",
            'role'=>'admin',
            'image' => "/users/default.jpeg",
            'email' => 'admin@admin.com',
            'password' =>Hash::make('admin'),
        ]);
    }
}
