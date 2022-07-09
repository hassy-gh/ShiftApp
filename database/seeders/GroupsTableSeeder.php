<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'group_name'   => 'sample_group',
            'name'         => 'sample group',
            'phone_number' => '0123456789',
            'password'     => Hash::make('password'),
        ]);
    }
}