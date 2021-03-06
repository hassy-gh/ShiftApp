<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'admin_name' => 'sample_admin',
            'last_name'  => 'sample',
            'first_name' => 'admin',
            'email'      => 'sample@admin.com',
            'password'   => Hash::make('password'),
        ]);
    }
}