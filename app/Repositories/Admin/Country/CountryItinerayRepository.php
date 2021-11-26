<?php

namespace App\Repositories\Admin\Country;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

use FileHelper;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Country;
use App\Models\CountryItinerary;

/**
 * Class CountryItinerayRepository.
 */
class CountryItinerayRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return CountryItinerary::class;
  }

  /**
   * @param int $paged
   * @param string $orderBy
   * @param string $sort
   *
   * @return mixed
   */
  public function getActivePaginated($paged = 15, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
  {
    return $this->model
      ->where('status', Country::STATUS_ACTIVE)
      ->orderBy($orderBy, $sort)
      ->paginate($paged);
  }


  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return Country
   */
  public function create(array $data): CountryItinerary
  {
    return DB::transaction(function () use ($data) {
      $itinerary = parent::create([
        'title' => $data['title'],
        'country_id' => $data['country'],
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'status' => $data['status'],
        'priority_status' => $data['priority_status'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'created_by' => Auth::guard('admin')->user()->id,
        'photo' => 'temp'
      ]);
      if ($itinerary) {
        $temp = FileHelper::getImageName($itinerary->id, $data['photo']->getClientOriginalExtension(), 0, $itinerary->getDirectory());
        $itinerary->update([
          'photo' => $temp['name']
        ]);
        FileHelper::upload($temp['path'], File::get($data['photo']));
      }
      return $itinerary;

      throw new GeneralException(__('Error while creating country itinerary'));
    });
  }


  /**
   * @param CountryItinerary  $itinerary
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return CountryItinerary
   */
  public function update(CountryItinerary $itinerary, array $data): CountryItinerary
  {

    return DB::transaction(function () use ($itinerary, $data) {
      $itinerary->update([
        'title' => $data['title'],
        'country_id' => $data['country'],
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'status' => $data['status'],
        'priority_status' => $data['priority_status'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
      ]);
      if (isset($data['photo'])) {

        $tempPath = \FileHelper::generateImagePath($itinerary->id, $itinerary->photo, $itinerary->getDirectory());
        FileHelper::deleteFile($tempPath);

        $temp = FileHelper::getImageName($itinerary->id, $data['photo']->getClientOriginalExtension(), 0, $itinerary->getDirectory());
        $itinerary->update([
          'photo' => $temp['name']
        ]);
        FileHelper::upload($temp['path'], File::get($data['photo']));
      }
      return $itinerary;
      throw new GeneralException(__('Error while updating country itinerary'));
    });
  }



  /**
   * @param CountryItinerary $category
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return CountryItinerary
   */
  public function forceDelete(CountryItinerary $category): CountryItinerary
  {
    return DB::transaction(function () use ($category) {
      if ($category->delete()) {

        return $category;
      }

      throw new GeneralException(__('Error while deleting category'));
    });
  }
  /**
   * @param int $id
   * @return bool
   */
  public function deleteItenarary(int $id){
    $countryItenararyDeleted = CountryItinerary::findorFail($id)->delete();
    if($countryItenararyDeleted){
      return true;
    }
    else{
      return false;
    }


  }
}
