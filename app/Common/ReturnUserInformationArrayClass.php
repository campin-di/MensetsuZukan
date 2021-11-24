<?php

namespace app\Common;
use Carbon\Carbon;

class ReturnUserInformationArrayClass
{
    public static function returnChannelArray()
    {
      $channelArray = [
        'Twitter',
        'Instagram',
        '知人/運営からの紹介',
        '所属組織/団体',
        'その他',
      ];
      return $channelArray;
    }
    public static function returnCompanyTypeArray()
    {
      $companyTypeArray = [
        '大手' => '大手（安定・着実、会社の規模が大きい）',
        '中小' => '中小（安定・着実、会社の規模が小さい）',
        'メガベンチャー' => 'メガベンチャー（挑戦・成長、会社の規模が大きい）',
        'ベンチャー' => 'ベンチャー（挑戦・成長、会社の規模が小さい）',
      ];
      return $companyTypeArray;
    }

    public static function returnJobTypeArray()
    {
    $jobtypeArray = [
      '営業',
      '事務・秘書・受付',
      '経理',
      '総務人事',
      'バイヤー',
      '法務',
      '企画',
      'マーケティング',
      '宣伝・広報',
      '経営コンサルタント',
      '為替ディーラー・トレーダー',
      '証券アナリスト',
      '融資・資産運用(ファンドマネージャー等）',
      'ファイナンシャルアドバイザー',
      'アクチュアリー',
      'システムエンジニア',
      'ネットワークエンジニア',
      'カスタマーエンジニア',
      'プログラマー',
      '研究職（製造系）',
      '設計開発',
      '生産・製造',
      'セールスエンジニア',
      '研究開発（医薬系）',
      '薬剤師',
      '栄養士',
      '福祉士・介護士・ホームヘルパー',
      '講師・インストラクター',
      '専門コンサルタント',
      '建築・土木設計',
      '施工管理',
      'Webデザイナー',
      'デザイナー',
      'ゲームクリエイター',
      '記者・ライター',
      '編集・制作',
      '販売・接客',
      '店長（店舗経営・運営）',
      'スーパーバイザー',
    ];
    return $jobtypeArray;
  }

  public static function returnIndustry()
  {
    $industryArray = [
      'IT・通信',
      'ソフトウェア・情報処理',
      'インターネット関連・ゲーム・アプリ関連',
      '機械・産業用装置・電機・OA機器',
      '自動車・自動車部品・輸送用機器',
      'コンピュータ・通信機器・精密機器',
      '電子部品・半導体',
      '食品・飲料・たばこ・飼料',
      '化学・医薬・化粧品',
      '鉄鋼・非鉄金属・金属製品',
      '石油・石炭・ゴム・プラスチック',
      'ガラス・セラミック・セメント',
      'パルプ・紙・紙加工・印刷・印刷関連',
      '日用品・文具・オフィス用品',
      '建材・エクステリア',
      'インテリア・住宅関連',
      'アパレル・服飾関連',
      'スポーツ・玩具・ゲーム機器',
      'その他メーカー・製造関連',
      '電気・ガス・石油・水道',
      '放送（テレビ・ラジオ含む）',
      '新聞・出版',
      '広告',
      'その他（芸能・エンタテインメント関連等）',
      '運輸（鉄道・航空・海運・物流等）',
      '総合商社',
      '専門商社',
      '百貨店・スーパー・ドラッグストア・コンビニ・ホームセンター',
      '通信販売、専門店・その他小売り',
      '銀行（協同組織金融含む）',
      '証券',
      '保険',
      'その他金融（クレジット等）',
      'リース・レンタル',
      'ディベロッパー',
      '建設・建築設計・ハウスメーカー',
      '設備関連',
      'プラント・プラントエンジニアリング',
      'デザイン・芸術関連',
      'コンサルティング・マーケティング・調査',
      'その他専門・技術サービス',
      'ホテル・旅館',
      '外食',
      'その他フード',
      '理美容・エステ・フィットネスクラブ',
      '旅行・観光',
      '家事サービス・クリーニング',
      '冠婚葬祭',
      'その他生活関連サービス',
      'アミューズメント・レジャーサービス',
      '教育関連',
      '医療・保育・介護、福祉',
      '環境・リサイクル・廃棄物処理',
      '整備・修理',
      '人材サービス',
      'その他事業サービス（警備、コールセンター等）',
      '官公庁'
    ];

    return $industryArray;
  }

  public static function returnUniversityClassArray()
  {
    $companyClassArray = [
      '東京一工',
      'その他旧帝大',
      '金岡千広・筑横千',
      'その他国公立',
      '早慶上智・ICU',
      'GMARCH',
      '関関同立',
      '日東駒専',
      '産近甲龍',
      'その他私立',
    ];
    return $companyClassArray;
  }

  public static function returnPrefectures(){
      $prefecturesArray = [
        "▼北海道エリア" => [
          '北海道',
        ],
        "▼東北エリア" => [
          '青森県',
          '岩手県',
          '秋田県',
          '宮城県',
          '山形県',
          '福島県',
        ],
        "▼ 関東エリア" => [
          '茨城県',
          '栃木県',
          '群馬県',
          '埼玉県',
          '千葉県',
          '東京都',
          '神奈川県',
        ],
        "▼ 甲信越・北陸エリア" => [
          '新潟県',
          '富山県',
          '石川県',
          '福井県',
          '山梨県',
          '長野県',
        ],
        "▼ 東海エリア" => [
          '岐阜県',
          '静岡県',
          '愛知県',
          '三重県',
        ],
        "▼ 関西エリア" => [
          '滋賀県',
          '京都府',
          '兵庫県',
          '大阪府',
          '奈良県',
          '和歌山県',
        ],
        "▼ 中国・四国エリア" => [
          '鳥取県',
          '島根県',
          '広島県',
          '岡山県',
          '山口県',
          '徳島県',
          '香川県',
          '愛媛県',
          '高知県',
        ],
        "▼ 九州・沖縄エリア" => [
          '福岡県',
          '佐賀県',
          '長崎県',
          '熊本県',
          '大分県',
          '宮崎県',
          '鹿児島県',
          '沖縄県',
        ],
        "▼ 海外" => [
          '海外',
        ],
        "▼ その他" => [
          '全国',
        ],
      ];

      return $prefecturesArray;
    }

    public static function returnTimeArray()
    {
      $timeArray = [
        'seven' => "7:00 - 7:30",
        'seven_h' => "7:30 - 8:00",
        'eight' => "8:00 - 8:30",
        'eight_h' => "8:30 - 9:00",
        'nine' => "9:00 - 9:30",
        'nine_h' => "9:30 - 10:00",
        'ten' => "10:00 - 10:30",
        'ten_h' => "10:30 - 11:00",
        'eleven' => "11:00 - 11:30",
        'eleven_h' => "11:30 - 12:00",
        'twelve' => "12:00 - 12:30",
        'twelve_h' => "12:30 - 13:00",
        'thirteen' => "13:00 - 13:30",
        'thirteen_h' => "13:30 - 14:00",
        'fourteen' => "14:00 - 14:30",
        'fourteen_h' => "14:30 - 15:00",
        'fifteen' => "15:00 - 15:30",
        'fifteen_h' => "15:30 - 16:00",
        'sixteen' => "16:00 - 16:30",
        'sixteen_h' => "16:30 - 17:00",
        'seventeen' => "17:00 - 17:30",
        'seventeen_h' => "17:30 - 18:00",
        'eighteen' => "18:00 - 18:30",
        'eighteen_h' => "18:30 - 19:00",
        'nineteen' => "19:00 - 19:30",
        'nineteen_h' => "19:30 - 20:00",
        'twenty' => "20:00 - 20:30",
        'twenty_h' => "20:30 - 21:00",
        'twentyone' => "21:00 - 21:30",
        'twentyone_h' => "21:30 - 22:00",
        'twentytwo' => "22:00 - 22:30",
        'twentytwo_h' => "22:30 - 23:00",
        'twentythree' => "23:00 - 23:30",
        'twentythree_h' => "23:30 - 24:00",
      ];
      return $timeArray;
    }

    public static function returnTimeColumns()
    {
      $timeColumns = [
        'seven' => "7:00 - 8:00",
        'eight' => "8:00 - 9:00",
        'nine' => "9:00 - 10:00",
        'ten' => "10:00 - 11:00",
        'eleven' => "11:00 - 12:00",
        'twelve' => "12:00 - 13:00",
        'thirteen' => "13:00 - 14:00",
        'fourteen' => "14:00 - 15:00",
        'fifteen' => "15:00 - 16:00",
        'sixteen' => "16:00 - 17:00",
        'seventeen' => "17:00 - 18:00",
        'eighteen' => "18:00 - 19:00",
        'nineteen' => "19:00 - 20:00",
        'twenty' => "20:00 - 21:00",
        'twentyone' => "21:00 - 22:00",
        'twentytwo' => "22:00 - 23:00",
        'twentythree' => "23:00 - 24:00",
      ];
      return $timeColumns;
    }

    public static function returnStartTimeArray()
    {
      $startTimeArray = [
        '大学1年・前期',
        '大学1年・後期',
        '大学2年・前期',
        '大学2年・後期',
        '大学3年・前期',
        '大学3年・後期',
        '大学4年・前期',
        '大学4年・後期',
      ];
      return $startTimeArray;
    }

    public static function returnEnglishLevelArray()
    {
      $englishLevelArray = [
        '挨拶レベル',
        '日常会話レベル',
        'ディベートレベル',
        'ビジネスレベル',
        'ネイティブレベル',
      ];
      return $englishLevelArray;
    }

    public static function returnToeicArray()
    {
      $toeicArray = [
        '未受験',
        '400未満',
        '400 ~ 449',
        '450 ~ 499',
        '500 ~ 549',
        '550 ~ 599',
        '600 ~ 649',
        '650 ~ 699',
        '700 ~ 749',
        '750 ~ 799',
        '800 ~ 849',
        '850 ~ 899',
        '900以上',
      ];
      return $toeicArray;
    }

    public static function returnStockTypeArray()
    {
      $stockTypeArray = [
        '東証一部',
        '東証二部',
        'マザーズ',
        'JASDAQ',
        'その他上場',
        '非上場',
      ];
      return $stockTypeArray;
    }

    public static function returnSelectionPhaseArray()
    {
      $selectionPhaseArray = [
        '1次面接',
        '1次&2次面接',
        '2次面接',
        '2次&最終面接',
        '最終面接',
        '全般',
      ];
      return $selectionPhaseArray;
    }
}
