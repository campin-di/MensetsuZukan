<?php

namespace app\Common;

class GoogleSheetClass
{
  public static function instance() {
      $credentials_path = storage_path('app/json/mensetsuzukan-a811af6e10b1.json');
      $client = new \Google_Client();
      $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
      $client->setAuthConfig($credentials_path);
      return new \Google_Service_Sheets($client);
  }
}
