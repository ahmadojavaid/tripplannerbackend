<?php

namespace App\Repositories\User\Country;

use App\Models\Country;
use App\Repositories\BaseRepository;

/**
 * Class CountryRepository.
 */
class CountryRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return Country::class;
  }

  public function list()
  {
    $list = $this->model
      ->where(['status' => Country::STATUS_ACTIVE])
      ->pluck('name', 'id');
    $list->put(-1, 'Highlighted');
    return $list->sort();
  }


  public function country(array $data)
  {
    return $this->model
      ->with([
        'essential',
        'countryFiles',
        'countryItineraries',
        'countryVideo',
        'countryCities',
        // 'commonCountryPlaces.placeFiles',
        'activeArticles'
      ])
      ->where(['slug' => $data['slug'], 'status' => Country::STATUS_ACTIVE])
      ->first();
  }
}
