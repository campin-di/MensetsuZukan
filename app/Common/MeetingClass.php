<?php
//require('vendor/autoload.php');

namespace app\Common;
use Carbon\Carbon;

use GuzzleHttp\Client;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Builder;

class MeetingClass {

    private const BASE_URI = 'https://api.zoom.us/v2/';

    private function createJwtToken($api_num)
    {
        $apiArray = [
          //yuu.yoshi12@outlook.jp
          ['RXC8M9U3STGFq7D9QgKNdA', 'LhyXsA4AMRL8SsSfMMl3sS6yMeX09dIiaHPA'],
          //pnbe26h9@s.okayama-u.ac.jp
          ['W5LD_Fb1TE6Ib9qJAIJzfg', 'cAm0ygjjuWp3E4GXB0TEOxCLSXnZlTqQAlIZ']
        ];

        $api_key = $apiArray[$api_num][0];
        $api_secret = $apiArray[$api_num][1];
        $signer = new Sha256;
        $key = new Key($api_secret);
        $time = time();
        $jwt_token = (new Builder())->setIssuer($api_key)
                                ->setExpiration($time + 3600)
                                ->sign($signer, $key)
                                ->getToken();
        return $jwt_token;
    }

    private function fetchUserId($api_num)
    {
        $method = 'GET';
        $path = 'users';
        $client_params = [
          'base_uri' => self::BASE_URI,
        ];
        $result = $this->sendRequest($method, $path, $client_params, $api_num);
        $user_id = $result['users'][0]['id'];
        return $user_id;
    }

    public function createMeeting($api_num, $date, $time)
    {
      //date : 2000-03-05 (形式)
      //time : nine (形式)
      $timeArray = [
        //標準時のせいか+9時間足される。
        'nine'      => "0:00:00",
        'ten'       => "1:00:00",
        'eleven'    => "2:00:00",
        'twelve'    => "3:00:00",
        'thirteen'  => "4:00:00",
        'fourteen'  => "5:00:00",
        'fifteen'   => "6:00:00",
        'sixteen'   => "7:00:00",
        'seventeen' => "8:00:00",
        'eighteen'  => "9:00:00",
        'nineteen'  => "10:00:00",
        'twenty'    => "11:00:00",
        'twentyone' => "12:00:00"
      ];

        $user_id = $this->fetchUserId($api_num);


        $params = [
          'topic' => '面接',
          'type' => 2, // 1-普通、2-意図した時間に会議を開始する。
          'start_time' => $date.'T'.$timeArray[$time].'Z',
//          'start_time' => '2021-04-15T20:30:00Z',
          'time_zone' => 'Asia/Tokyo',
          'agenda' => '面接の実施',
          'settings' => [
            'host_video' => true,
            'participant_video' => true,
            'join_before_host' => false,
            'approval_type' => 0,
            'auto_recording' => 'local',
            'audio' => 'both',
            'enforce_login' => false,
            'waiting_room' => false,
          ]
        ];

        $method = 'POST';
        $path = 'users/'. $user_id .'/meetings';
        $client_params = [
          'base_uri' => self::BASE_URI,
          'json' => $params
        ];
        $result = $this->sendRequest($method, $path, $client_params, $api_num);
        return $result;
    }

    private function sendRequest($method, $path, $client_params, $api_num)
    {
        $client = new Client($client_params);
        $jwt_token = $this->createJwtToken($api_num);
        $response = $client->request($method,
                        $path,
                        [
                          'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer ' . $jwt_token,
                          ]
                        ]);
        $result_json = $response->getBody()->getContents();
        $result = json_decode($result_json, true);
        return $result;
    }
}

