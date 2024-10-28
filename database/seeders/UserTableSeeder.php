<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'john.doe@example.com',
                'password' => Hash::make('password'), // password
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}