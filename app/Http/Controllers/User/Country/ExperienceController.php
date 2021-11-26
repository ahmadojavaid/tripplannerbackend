<?php

namespace App\Http\Controllers\User\Country;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Repositories\User\Country\ExperienceRepository;

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
    $experiences = Experience::where('status', Experience::STATUS_ACTIVE)->paginate(15);
    return view('pages.user.experience.index', [
      'experiences' => $experiences
    ]);
  }

  public function experience($slug)
  {
    $experience = $this->experienceRepository->experience([
      'slug' => $slug
    ]);

    return view('pages.user.experience.detail', [
      'experience' => $experience,
      'navbarOptions' => [
        'type' => 'combined'
      ],
      'essentials' => $experience->essentials->pluck('value', 'slug'),
      'videos' =>  $experience->videos->pluck('value', 'slug'),
    ]);
  }
}
