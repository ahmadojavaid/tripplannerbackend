<?php

namespace App\Http\Controllers\Admin\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\StorePlaceFile;
use App\Models\CountryPlace;
use App\Repositories\Admin\Place\PlaceFileRepository;
use Illuminate\Http\Request;


class PlaceFileController extends Controller
{
  /**
   * PlaceFileController constructor.
   *
   * @param PlaceFileRepository $placeFileRepository
   */
  public function __construct(PlaceFileRepository $placeFileRepository)
  {
    $this->placeFileRepository = $placeFileRepository;
  }


  public function upload(CountryPlace $place)
  {
    $data = $this->placeFileRepository->upload($place);
    return response()->json($data);
  }


  public function store(StorePlaceFile $request, CountryPlace $place)
  {
    return $this->placeFileRepository->store($request->only('file'), $place);
  }

  public function destroy(Request  $request, CountryPlace $place)
  {
    return $this->placeFileRepository->destroy($request->only('name'), $place);
  }
}
