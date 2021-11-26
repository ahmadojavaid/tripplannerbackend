<?php

namespace App\Http\Controllers\Admin\Experience;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Experience\StoreEssentials;
use App\Http\Requests\Admin\Experience\StoreExperience;
use App\Http\Requests\Admin\Experience\StoreVideos;
use App\Http\Requests\Admin\Experience\UpdateExperience;
use App\Models\CountryPlace;
use App\Models\Experience;
use App\Models\ExperienceCategory;
use App\Models\ExperienceResidual;
use App\Repositories\Admin\Experience\ExperienceRepository;

class ExperienceController extends Controller
{

  protected  $experienceRepository;
  /**
   * ExperienceController constructor.
   *
   * @param ExperienceRepository $experienceRepository
   */
  public function __construct(ExperienceRepository $experienceRepository)
  {
    $this->experienceRepository = $experienceRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Experiences"]
    ];


    return view('pages.admin.experience.index', [
      'experiences' => $this->experienceRepository->getActive(),
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function create()
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/experiences", 'name' => "Experiences"], ['name' => "Create Experience"]
    ];

    return view('pages.admin.experience.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Experience::getStatusArr(),
      'priorityArr' => Experience::getPriorityStatusArr(),
      'placeArr' => CountryPlace::getPlaceArr(),
      'categoryArr' => ExperienceCategory::getCategoryArr(),
      'typeArr' => Experience::getTypeArr()
    ]);
  }

  public function store(StoreExperience $request)
  {
    $this->experienceRepository->create($request->all());
    return redirect()->route('admin.experience.index')->with('success', __('Country Experience created'));
  }

  public function edit(Experience $experience)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/experiences", 'name' => "Experiences"], ['name' => "Update Experience"]
    ];

    return view('pages.admin.experience.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Experience::getStatusArr(),
      'priorityArr' => Experience::getPriorityStatusArr(),
      'experience' => $experience,
      'essentailFields' => ExperienceResidual::getFields(),
      'essentailFieldData' => ExperienceResidual::getFieldsArr($experience->id),
      'videoFieldData' => ExperienceResidual::getVideoFieldsArr($experience->id),
      'placeArr' => CountryPlace::getPlaceArr(),
      'categoryArr' => ExperienceCategory::getCategoryArr(),
      'typeArr' => Experience::getTypeArr()

    ]);
  }


  public function update(UpdateExperience $request, Experience $experience)
  {
    $this->experienceRepository->update($experience, $request->all());
    return redirect()->route('admin.experience.index')->with('success', __('Country Experience updated'));
  }


  public function destroy($id)
  {
    $deleteStatus = $this->experienceRepository->deleteExperience($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting Experience'));
    }
  }


  public function essentials(StoreEssentials $request, Experience $experience)
  {
    $this->experienceRepository->essentials($request->only(
      'recommended-for',
      'why-this-experience',
      'what-you-can-expect',
      "what's-included",
      "what's-not-included"
    ), $experience->id);

    return redirect()->route('admin.experience.edit', $experience->id)->with('success', __('Experience Essential Updated'));
  }

  public function videos(StoreVideos $request, Experience $experience)
  {

    $this->experienceRepository->videos($request->only('video-link'), $experience->id);

    return redirect()->route('admin.experience.edit', $experience->id)->with('success', __('Experience Video Updated'));
  }
}
