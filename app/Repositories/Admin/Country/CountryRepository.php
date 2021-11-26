<?php

namespace App\Repositories\Admin\Country;

use App\Models\CountryFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

use App\Models\Country;
use App\Models\CountryEssential;
use App\Models\CountryVideo;
use App\Models\UserArticle;
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

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Country
   */
  public function create(array $data): Country
  {
    return DB::transaction(function () use ($data) {

      $country = parent::create([
        'name' => $data['name'],
        'slug' => Str::slug($data['name']),
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],

      ]);
      return $country;

      throw new Exception(__('Error while creating country'));
    });
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Country
   */
  public function update(Country $country, array $data): Country
  {
    return DB::transaction(function () use ($country, $data) {

      $country->update([
        'name' => $data['name'],
        'slug' => Str::slug($data['name']),
        'short_description' => $data['short_description'],
        'status' => $data['status'],
        'priority_status' => $data['priority'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
      ]);
      return $country;

      throw new Exception(__('Error while creating country'));
    });
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Country
   */
  public function storeEssentials(array $data, $countryId): CountryEssential
  {
    return DB::transaction(function () use ($data, $countryId) {
      // Retrieve by country_id, or instantiate with the when_to_go, delayed, and arrival_time attributes...
      $essential = CountryEssential::updateOrCreate([
        'country_id' => $countryId,
      ], [
        'when_to_go' => $data['when_to_go'],
        'weather' => $data['weather'],
        'getting_there' => $data['getting_there'],
        'travel_expenses' => $data['travel_expenses'],
        'culture' => $data['culture'],
      ]);



      return $essential;

      throw new Exception(__('Error while adding essential'));
    });
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Country
   */
  public function storeVideos(array $data, $countryId): CountryVideo
  {

    return DB::transaction(function () use ($data, $countryId) {
      // Retrieve by country_id, or instantiate with the when_to_go, delayed, and arrival_time attributes...
      $video = CountryVideo::updateOrCreate([
        'country_id' => $countryId,
      ], [
        'description' => $data['description'],
        'link_1' => $data['link_1'],
        'link_2' => $data['link_2'],
        'link_3' => $data['link_3'],
      ]);

      return $video;
      throw new Exception(__('Error while adding video'));
    });
  }



  /**
   * @param UserArticle $category
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return UserArticle
   */
  public function forceDelete(UserArticle $category): UserArticle
  {
    return DB::transaction(function () use ($category) {
      if ($category->delete()) {

        return $category;
      }

      throw new Exception(__('Error while deleting category'));
    });
  }

  /**
   * @param int $id
   * @return bool
   */
  public function deleteCountry(int $id){
   $countryDeleted = Country::findorFail($id)->delete();
    CountryEssential::where('country_id',$id)->delete();
    CountryFile::where('country_id',$id)->delete();
     CountryVideo::where('country_id',$id)->delete();
    if($countryDeleted){
      return true;
    }
    else{
      return false;
    }
  }
}
