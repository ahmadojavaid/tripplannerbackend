<?php

namespace App\Http\Controllers\Admin\Property;

use App\Helpers\General\AmadeusHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Property\StoreEssentials;
use App\Http\Requests\Admin\Property\StoreProperty;
use App\Http\Requests\Admin\Property\StoreVideos;
use App\Http\Requests\Admin\Property\UpdateProperty;
use App\Models\CountryPlace;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyResidual;
use App\Models\PropertyType;
use App\Repositories\Admin\Property\PropertyRepository;

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


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Properties"]
    ];


    return view('pages.admin.property.index', [
      'properties' => $this->propertyRepository->getActive(),
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties", 'name' => "Properties"], ['name' => "Create Property"]
    ];

    return view('pages.admin.property.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Property::getStatusArr(),
      'priorityArr' => Property::getPriorityStatusArr(),
      'placeArr' => CountryPlace::getPlaceArr(),
      'categoryArr' => PropertyCategory::getCategoryArr(),
      'typeArr' => PropertyType::getTypeArr()
    ]);
  }

  public function store(StoreProperty $request)
  {
    $this->propertyRepository->create($request->all());
    return redirect()->route('admin.property.index')->with('success', __('Country Property created'));
  }

  public function edit(Property $property)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties", 'name' => "Properties"], ['name' => "Update Property"]
    ];

    return view('pages.admin.property.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Property::getStatusArr(),
      'priorityArr' => Property::getPriorityStatusArr(),
      'property' => $property,
      'essentailFields' => PropertyResidual::getFields(),
      'essentailFieldData' => PropertyResidual::getFieldsArr($property->id),
      'videoFieldData' => PropertyResidual::getVideoFieldsArr($property->id),
      'placeArr' => CountryPlace::getPlaceArr(),
      'categoryArr' => PropertyCategory::getCategoryArr(),
      'typeArr' => PropertyType::getTypeArr()
    ]);
  }


  public function update(UpdateProperty $request, Property $property)
  {
    $this->propertyRepository->update($property, $request->all());
    return redirect()->route('admin.property.index')->with('success', __('Country Property updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->propertyRepository->deleteProperty($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }


  public function essentials(StoreEssentials $request, Property $property)
  {
    $this->propertyRepository->essentials($request->only(
      'why-this-property-is-special',
      'rooms',
      'experiences',
      "cuisine",
      "what's-included"
    ), $property->id );

    return redirect()->route('admin.property.edit', $property->id)->with('success', __('Property Essential Updated'));
  }

  public function videos(StoreVideos $request, Property $property)
  {
    $this->propertyRepository->videos($request->only('video-link'), $property->id);

    return redirect()->route('admin.property.edit', $property->id)->with('success', __('Property Video Added'));
  }

  public function externalHotel()
  {

    $data = (new AmadeusHelper)->getHotelList();
    $items = collect($data['data'])->map(function ($hotel) {
      return ['name' => $hotel['hotel']['name'],  'id' => $hotel['hotel']['hotelId']];
    });
  }
}
