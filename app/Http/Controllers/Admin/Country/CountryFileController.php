<?php

namespace App\Http\Controllers\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreCountryFile;
use App\Repositories\Admin\Country\CountryFileRepository;
use Illuminate\Http\Request;


class CountryFileController extends Controller
{
  /**
   * CountryFileController constructor.
   *
   * @param CountryFileRepository $countryFileRepository
   */
  public function __construct(CountryFileRepository $countryFileRepository)
  {
    $this->countryFileRepository = $countryFileRepository;
  }


  public function upload($id)
  {
    $data = $this->countryFileRepository->upload($id);
    return response()->json($data);
  }


  public function store(StoreCountryFile $request, $id)
  {
    return $this->countryFileRepository->store($request->only('file'), $id);
  }

  public function destroy(Request  $request, $id)
  {
    return $this->countryFileRepository->destroy($request->only('name'), $id);
  }
}
