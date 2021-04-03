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
            'name' => '吉田裕哉',
            'username' => 'YuU4i2',
            'email' => 'yuu.yoshi12@outlook.jp',
            'password' => Hash::make('password'),
            'status' => 1,
            'university_id' => 1,
            'faculty_id' => 3,
            'department_id' => 5,
            'plan' => 'contributor',
            'remember_token' => Str::random(10),
          ],
        ]);

        \App\Models\User::factory(50)->create();
    }
}
