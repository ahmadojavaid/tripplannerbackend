<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UpdateProfile;
use App\Models\User;
use App\Repositories\User\Profile\ProfileRepository;

class ProfileController extends Controller
{

  /**
   * ProfileController constructor.
   *
   * @param UserArticleRepository $articleRepository
   * @param CountryRepository $countrRepository
   */
  public function __construct(ProfileRepository $profileRepository)
  {
    $this->profileRepository = $profileRepository;
  }



  public function index()
  {
    session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
    return view('pages.user.profile.index');
  }

  public function update(UpdateProfile $request,  User  $user)
  {
    $this->profileRepository->update($user, $request->all());
    return redirect()->route('user.profile')->withFlashSuccess(__('User Profile Updated'));
  }
}
