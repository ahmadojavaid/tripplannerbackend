<?php

namespace App\Helpers\General;

use Illuminate\Support\Facades\Http;

/**
 * @link https://developers.amadeus.com/self-service/apis-docs/guides/pagination-264
 */
class AmadeusHelper
{

  public function __construct()
  {
    // $this->var = $var;
  }

  const BASE_URL = "https://api.amadeus.com/";
  // const BASE_URL = "https://test.api.amadeus.com/";



  public function generateToken()
  {

    $response = Http::asForm()->post(self::BASE_URL . 'v1/security/oauth2/token', [
      'client_id' => 'o2EmX8dOpNbgAuc5zcQ465hcV1gA88AX',
      // 'client_id' => '1UMNJGH9AGmZiuRz0lohCbhjFzB6Z5al',
      'client_secret' => '1VGKcTMcqwalIaRG',
      'grant_type' => 'client_credentials'
    ]);

    if ($response->ok()) {
      session(['amadeus-token' => $response->json()['access_token']]);
      return $this->getToken();
    }
  }

  public function validateToken()
  {
    $response = Http::get(self::BASE_URL . 'v1/security/oauth2/token/' . session('amadeus-token'));
    if (!$response->ok())
      $this->generateToken();
  }

  public function getHotelList($cityCode = "LON")
  {
    $response = Http::withToken($this->getToken())
      ->get(self::BASE_URL . 'v2/shopping/hotel-offers', [
        'cityCode' => $cityCode
      ]);

    if ($response->status() == 401) {
      $this->generateToken();
      return $this->getHotelList($cityCode);
    }
    return $response->json();
  }


  public function getHotelDetail($hotelId = "")
  {
    $response = Http::withToken($this->getToken())
      ->get(self::BASE_URL . 'v2/shopping/hotel-offers/by-hotel', [
        'hotelId' => $hotelId
      ]);
    if ($response->status() == 401) {
      $this->generateToken();
      return $this->getHotelDetail($hotelId);
    }
    return $response->json();
  }

  public function getAirlinePrice($departure,  $destionation)
  {
    // dd($departure,  $destionation);
    $response = Http::withToken($this->getToken())
      ->get(self::BASE_URL . 'v1/shopping/flight-dates', [
        'origin' => $departure,
        'destination' => $destionation
      ]);

    if ($response->status() == 401) {
      $this->generateToken();
      return  $this->getAirlinePrice($departure,  $destionation);
    }

    return $response->json();
  }

  public function getToken()
  {
    return session('amadeus-token');
  }
}
