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
        'seven'         => "7:00:00",
        'seven_h'       => "7:30:00",
        'eight'         => "8:00:00",
        'eight_h'       => "8:30:00",
        'nine'          => "9:00:00",
        'nine_h'        => "9:30:00",
        'ten'           => "10:00:00",
        'ten_h'         => "10:30:00",
        'eleven'        => "11:00:00",
        'eleven_h'      => "11:30:00",
        'twelve'        => "12:00:00",
        'twelve_h'      => "12:30:00",
        'thirteen'      => "13:00:00",
        'thirteen_h'    => "13:30:00",
        'fourteen'      => "14:00:00",
        'fourteen_h'    => "14:30:00",
        'fifteen'       => "15:00:00",
        'fifteen_h'     => "15:30:00",
        'sixteen'       => "16:00:00",
        'sixteen_h'     => "16:30:00",
        'seventeen'     => "17:00:00",
        'seventeen_h'   => "17:30:00",
        'eighteen'      => "18:00:00",
        'eighteen_h'    => "18:30:00",
        'nineteen'      => "19:00:00",
        'nineteen_h'    => "19:30:00",
        'twenty'        => "20:00:00",
        'twenty_h'      => "20:30:00",
        'twentyone'     => "21:00:00",
        'twentyone_h'   => "21:30:00",
        'twentytwo'     => "22:00:00",
        'twentytwo_h'   => "22:30:00",
        'twentythree'   => "23:00:00",
        'twentythree_h' => "23:30:00",
      ];
      /*
      $endTimeH = explode(":",$timeArray[$time])[0];
      $endTimeM = explode(":",$timeArray[$time])[1];
      if($endTimeM == 30){
        $endTimeM = "00";
        $endTimeH = $endTimeH + 1;
      }else{
        $endTimeM = 30;
      }
      */

      $user_id = $this->fetchUserId($api_num);
      $params = [
        'topic' => '面接',
        'type' => 2, // 1-普通、2-意図した時間に会議を開始する。
        'start_time' => $date.'T'.$timeArray[$time],
        'timezone' => 'Asia/Tokyo',
        'duration' => 30,
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

