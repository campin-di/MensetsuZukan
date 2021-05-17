<?php

namespace Database\Factories;

use App\Models\HrUser;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Common\ReturnUserInformationArrayClass;

class HrUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HrUser::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
    public function definition()
    {
      $industryArray = ReturnUserInformationArrayClass::returnIndustry();
      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $companyTypeArray = ReturnUserInformationArrayClass::returnCompanyTypeArray();
      $stockTypeArray = ReturnUserInformationArrayClass::returnStockTypeArray();
      $selectionPhaseArray = ReturnUserInformationArrayClass::returnSelectionPhaseArray();

      return [
        'email' => $this->faker->unique()->companyEmail,
        'password' => Hash::make('password'),
        'name' => $this->faker->name,
        'kana_name' => $this->faker->kanaName,
        'gender' => mt_rand(1, 2),
        'plan' => 'offer',
        'company' => $this->faker->company,
        'company_type' => $companyTypeArray[array_rand($companyTypeArray)],
        'industry' => $industryArray[array_rand($industryArray)],
        'location' => $this->faker->prefecture,
        'stock_type' => $stockTypeArray[array_rand($stockTypeArray)],
        'selection_phase' => $selectionPhaseArray[array_rand($selectionPhaseArray)],
        'workplace' => $this->faker->prefecture,
        'summary' => $this->faker->sentence,
        'recruitment' => $this->faker->url,
        'site' => $this->faker->url,
        'introduction' => $this->faker->sentence,
        'pr' => $this->faker->sentence,
        'status' => 1,
        'remember_token' => Str::random(10),
      ];
    }
}
