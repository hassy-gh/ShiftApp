<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_name' => 'sample_user',
            'last_name' => 'sample',
            'first_name' => 'user',
            'email' => 'sample@user.com',
            'password' => Hash::make('password'),
        ]);
    }
}