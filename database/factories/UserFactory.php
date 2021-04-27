<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'email' => $this->faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'username' => $this->faker->unique()->userName,
        'name' => $this->faker->name,
        'kana_name' => $this->faker->kanaName,
        'gender' => mt_rand(1, 2),
        'plan' => 'contributor',
        'graduate_year' => '2023',
        'major' => mt_rand(1, 2),
        'university_id' => 1,
        'faculty_id' => 3,
        'department_id' => 5,
        'status' => mt_rand(1, 50),
        'remember_token' => Str::random(10),
      ];
    }
}
