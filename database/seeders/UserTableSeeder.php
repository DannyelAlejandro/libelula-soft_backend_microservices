<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole('ADMIN');
        
        User::create([
            'username' => 'authors',
            'name' => 'authors',
            'email' => 'authors@authors.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole('AUTHORS');
        
        User::create([
            'username' => 'books',
            'name' => 'Books',
            'email' => 'books@books.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole('BOOKS');
    }
}
