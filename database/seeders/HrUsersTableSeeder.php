<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HrUsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
      DB::table('hr_users')->insert([
        [
          'name' => '吉裕',
          'username' => 'yuu412',
          'email' => 'yuu.yoshi12@outlook.jp',
          'password' => Hash::make('paspaspas'),
          'status' => 1,
          'company_id' => mt_rand(0, 99),
          'plan' => 'paid',
          'remember_token' => Str::random(10),
        ],
      ]);

      \App\Models\HrUser::factory(30)->create();
    }
}
