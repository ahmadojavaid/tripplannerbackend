<?php

namespace App\Http\Controllers\Admin\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Property\StoreCategoryProperty;
use App\Http\Requests\Admin\Property\UpdateCategoryProperty;
use App\Models\PropertyCategory;
use App\Repositories\Admin\Property\PropertyCategoryRepository;



class PropertyCategoryController extends Controller
{

  protected $categoryRepository;

  /**
   * PropertyController constructor.
   *
   * @param PropertyCategoryRepository $categoryRepository
   */
  public function __construct(PropertyCategoryRepository $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Property Categories"]
    ];

    $categories = $this->categoryRepository->activeList();
    return view('pages.admin.property.category.index', [
      'categories' => $categories,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties/categories", 'name' => "Property Categories"], ['name' => "Create Category"]
    ];

    return view('pages.admin.property.category.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => PropertyCategory::getStatusArr(),
      'priorityArr' => PropertyCategory::getPriorityStatusArr(),
    ]);
  }

  public function store(StoreCategoryProperty $request)
  {
    $this->categoryRepository->create($request->all());

    return redirect()->route('admin.property.category.index')->with('success', __('Propertyd Category created'));
  }

  public function edit(PropertyCategory $category)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/properties/categories", 'name' => "Property Categories"], ['name' => "Update Category"]
    ];

    return view('pages.admin.property.category.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => PropertyCategory::getStatusArr(),
      'priorityArr' => PropertyCategory::getPriorityStatusArr(),
      'category' => $category
    ]);
  }


  public function update(UpdateCategoryProperty $request, PropertyCategory $category)
  {
    $this->categoryRepository->update($category, $request->all());
    return redirect()->route('admin.property.category.index')->with('success', __('Property Category updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->categoryRepository->deletePropertyCategory($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting country'));
    }
  }
}
