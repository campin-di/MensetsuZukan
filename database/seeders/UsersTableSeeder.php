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
            'name' => 'のびのび太',
            'username' => 'nobita',
            'email' => 'nobita@example.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'university_id' => 1,
            'faculty_id' => 3,
            'department_id' => 5,
            'details_id' => 1,
            'plan' => 'audience',
            'remember_token' => Str::random(10),
          ],
          [
            'name' => 'ボクドラえもん',
            'username' => 'doraemon',
            'email' => 'draemon@example.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'university_id' => 2,
            'faculty_id' => 4,
            'department_id' => 6,
            'details_id' => 2,
            'plan' => 'contributor',
            'remember_token' => Str::random(10),
          ]
        ]);
    }
}
