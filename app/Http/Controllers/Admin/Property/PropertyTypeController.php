<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Property\StoreTypeProperty;
use App\Http\Requests\Admin\Property\UpdateTypeProperty;
use App\Models\PropertyType;
use App\Repositories\Admin\Property\PropertyTypeRepository;



class PropertyTypeController extends Controller
{
  protected $typeRepository;

  /**
   * PropertyController constructor.
   *
   * @param PropertyTypeRepository $typeRepository
   */
  public function __construct(PropertyTypeRepository $typeRepository)
  {
    $this->typeRepository = $typeRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Property Types"]
    ];

    $types = $this->typeRepository->activeList();
    return view('pages.admin.property.type.index', [
      'types' => $types,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties/types", 'name' => "Property Types"], ['name' => "Create Type"]
    ];

    return view('pages.admin.property.type.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => PropertyType::getStatusArr(),
      'priorityArr' => PropertyType::getPriorityStatusArr(),
    ]);
  }

  public function store(StoreTypeProperty $request)
  {
    $this->typeRepository->create($request->all());

    return redirect()->route('admin.property.type.index')->with('success', __('Propertyd Type created'));
  }

  public function edit(PropertyType $type)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties/types", 'name' => "Property Types"], ['name' => "Update Type"]
    ];

    return view('pages.admin.property.type.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => PropertyType::getStatusArr(),
      'priorityArr' => PropertyType::getPriorityStatusArr(),
      'type' => $type
    ]);
  }


  public function update(UpdateTypeProperty $request, PropertyType $type)
  {
    $this->typeRepository->update($type, $request->all());
    return redirect()->route('admin.property.type.index')->with('success', __('Property Type updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->typeRepository->deletePropertyType($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }
}
