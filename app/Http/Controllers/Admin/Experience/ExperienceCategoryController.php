<?php

namespace App\Http\Controllers\Admin\Experience;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Experience\StoreCategoryExperience;
use App\Http\Requests\Admin\Experience\UpdateCategoryExperience;
use App\Models\ExperienceCategory;
use App\Repositories\Admin\Experience\ExperienceCategoryRepository;



class ExperienceCategoryController extends Controller
{

  protected $categoryRepository;

  /**
   * ExperienceController constructor.
   *
   * @param ExperienceCategoryRepository $categoryRepository
   */
  public function __construct(ExperienceCategoryRepository $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Experience Categories"]
    ];

    $categories = $this->categoryRepository->activeList();
    return view('pages.admin.experience.category.index', [
      'categories' => $categories,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/experiences/categories", 'name' => "Experience Categories"], ['name' => "Create Category"]
    ];

    return view('pages.admin.experience.category.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => ExperienceCategory::getStatusArr(),
      'priorityArr' => ExperienceCategory::getPriorityStatusArr(),
    ]);
  }

  public function store(StoreCategoryExperience $request)
  {
    $this->categoryRepository->create($request->all());

    return redirect()->route('admin.experience.category.index')->with('success', __('Experienced Category created'));
  }

  public function edit(ExperienceCategory $category)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/experiences/categories", 'name' => "Experience Categories"], ['name' => "Update Category"]
    ];

    return view('pages.admin.experience.category.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => ExperienceCategory::getStatusArr(),
      'priorityArr' => ExperienceCategory::getPriorityStatusArr(),
      'category' => $category
    ]);
  }


  public function update(UpdateCategoryExperience $request, ExperienceCategory $category)
  {
    $this->categoryRepository->update($category, $request->all());
    return redirect()->route('admin.experience.category.index')->with('success', __('Experience Category updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->categoryRepository->deleteExperience($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting Category'));
    }
  }
}
