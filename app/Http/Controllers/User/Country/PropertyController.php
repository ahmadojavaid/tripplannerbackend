<?php

namespace App\Http\Controllers\User\Country;

use App\Http\Controllers\Controller;
use App\Repositories\User\Country\PropertyRepository;

class PropertyController extends Controller
{
  protected $propertyRepository;

  /**
   * PropertyController constructor.
   *
   * @param PropertyRepository $propertyRepository
   */
  public function __construct(PropertyRepository $propertyRepository)
  {
    $this->propertyRepository = $propertyRepository;
  }


  public function property($slug)
  {

    $property = $this->propertyRepository->property([
      'slug' => $slug
    ]);

    return view('pages.user.property.detail', [
      'property' => $property,
      'navbarOptions' => [
        'type' => 'combined'
      ],
      'essentials' => $property->essentials->pluck('value', 'slug'),
      'videos' =>  $property->videos->pluck('value', 'slug'),
    ]);
  }
}
