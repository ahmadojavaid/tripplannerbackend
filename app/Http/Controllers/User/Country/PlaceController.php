<?php

namespace App\Http\Controllers\User\Country;

use App\Http\Controllers\Controller;
use App\Repositories\User\Country\PlaceRepository;

class PlaceController extends Controller
{
  protected $placeRepository;

  /**
   * PlaceController constructor.
   *
   * @param PlaceRepository $placeRepository
   */
  public function __construct(PlaceRepository $placeRepository)
  {
    $this->placeRepository = $placeRepository;
  }


  public function place($slug)
  {
    $place = $this->placeRepository->place([
      'slug' => $slug
    ]);

    return view('pages.user.place.detail', [
      'place' => $place,
      'navbarOptions' => [
        'type' => 'combined'
      ],
      'essentials' => $place->essentials->pluck('value', 'slug'),
      'videos' =>  $place->videos->pluck('value', 'slug'),
    ]);
  }
}
