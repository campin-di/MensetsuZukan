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
             'name' => '人事仁二',
             'username' => 'zinzi',
             'email' => 'zinzi@example.com',
             'password' => Hash::make('password'),
             'status' => 1,
             'company_id' => 1,
             'details_id' => 1,
             'plan' => 'paid',
             'remember_token' => Str::random(10),
           ],
           [
             'name' => '人事仁二子',
             'username' => 'zinziko',
             'email' => 'zinziko@example.com',
             'password' => Hash::make('password'),
             'status' => 2,
             'company_id' => 2,
             'details_id' => 2,
             'plan' => 'free',
             'remember_token' => Str::random(10),
           ],
           [
             'name' => '佐藤一郎',
             'username' => 'satosan',
             'email' => 'sato@example.com',
             'password' => Hash::make('password'),
             'status' => 1,
             'company_id' => 3,
             'details_id' => 3,
             'plan' => 'free',
             'remember_token' => Str::random(10),
           ],
           [
             'name' => '小島ユリ',
             'username' => 'kozima',
             'email' => 'kozima@example.com',
             'password' => Hash::make('password'),
             'status' => 2,
             'company_id' => 5,
             'details_id' => 4,
             'plan' => 'paid',
             'remember_token' => Str::random(10),
           ],
           [
             'name' => '山中慎吾',
             'username' => 'yamasan',
             'email' => 'yamanaka@example.com',
             'password' => Hash::make('password'),
             'status' => 1,
             'company_id' => 3,
             'details_id' => 5,
             'plan' => 'free',
             'remember_token' => Str::random(10),
           ],
         ]);
    }
}