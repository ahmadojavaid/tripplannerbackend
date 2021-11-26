<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\StorePlaceFile;
use App\Models\Property;
use App\Repositories\Admin\Property\PropertyFileRepository;
use Illuminate\Http\Request;


class PropertyFileController extends Controller
{
  /**
   * PropertyFileController constructor.
   *
   * @param PropertyFileRepository $propertyFileRepository
   */
  public function __construct(PropertyFileRepository $propertyFileRepository)
  {
    $this->propertyFileRepository = $propertyFileRepository;
  }


  public function upload(Property $property)
  {

    $data = $this->propertyFileRepository->upload($property);
    return response()->json($data);
  }


  public function store(StorePlaceFile $request, Property $property)
  {
    return $this->propertyFileRepository->store($request->only('file'), $property);
  }

  public function destroy(Request  $request, Property $property)
  {
    return $this->propertyFileRepository->destroy($request->only('name'), $property);
  }
}
