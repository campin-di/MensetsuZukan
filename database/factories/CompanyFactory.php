<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $keyArray = ["メーカー", "商社", "小売", "金融", "サービス・インフラ", "ソフトウェア", "広告・出版・マスコミ"];
      $industryArray = [
        "メーカー" => ["食品・農林・水産", "建設・住宅・インテリア", "繊維・化学・薬品・化粧品", "鉄鋼・金属・鉱業"],
        "商社" => ["総合商社", "専門商社"],
        "小売" => ["百貨店・スーパー", "コンビニ", "専門店"],
        "金融" => ["銀行・証券", "クレジット", "信販・リース", "その他金融", "生保・損保"],
        "サービス・インフラ" => ["不動産", "鉄道・航空・運輸", "電力・ガス", "フードサービス", "ホテル・旅行"],
        "ソフトウェア" => ["ソフトウェア", "インターネット", "通信"],
        "広告・出版・マスコミ" => ["放送", "新聞", "出版", "広告"],
      ];
      $zero6 = mt_rand(0, 6);

      return [
          'name' => $this->faker->unique()->company,
          'industry' => Arr::random($industryArray[$keyArray[$zero6]]),
          'industry_group' => $keyArray[$zero6],
      ];
    }
}
