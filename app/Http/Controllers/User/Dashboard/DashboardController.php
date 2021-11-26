<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Enquire\StoreEnquire;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\Enquire;
use App\Models\Experience;
use App\Models\Setting;
use App\Models\Trip;
use App\Models\UserArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
//dump(Auth::user());
//    dump(session()->get('places'));
//    dump(session()->get('properties'));
//    dump(session()->get('experiences'));
//    dump(session()->get('trip-title'));
//    dump(session()->get('trip-description'));
//    dump(session()->get('place_transport'));
//    dump(session()->get('place_nights'));
    session()->forget(['places', 'properties','experiences','trip-title','trip-description','place_transport','place_nights']);
    $articles = UserArticle::where([
      'priority_status' => UserArticle::PRIORITY_STATUS_HIGHLIGHTED,
      'status' => UserArticle::STATUS_ACTIVE
    ])->limit(10)->get();

    $trips = Trip::where([
      'priority_status' => Trip::PRIORITY_STATUS_HIGHLIGHTED,
      'status' => Trip::STATUS_ACTIVE
    ])->limit(10)->get();



    $setting = Setting::where('slug', 'how-it-work-video')->first();

    $countries = Country::get();
    return view('pages.user.dashboard.index', [
      'setting' => $setting,
      'articles' => $articles,
      'trips' => $trips,
      'countries' => $countries
    ]);
  }

  public function search(Request $request){

    if (strpos($request->countries,'countries') !== false) {
      return redirect()->to($request->countries);
    }
    if(CountryPlace::where('name', 'like', '%'.$request->countries.'%')->exists())
    {
      $exp = CountryPlace::where('name', 'like', '%'.$request->countries.'%')->first();
      return redirect()->to(route('user.place.detail',$exp->slug) );
    }

    if(Experience::where('title', 'like', '%'.$request->countries.'%')->exists())
    {
      $exp = Experience::where('title', 'like', '%'.$request->countries.'%')->first();
      return redirect()->to(route('user.experience.detail',$exp->slug) );
    }

  }

  public function aboutUs()
  {
    $setting = Setting::where('slug', 'how-it-work-video')->first();

    return view('pages.user.about-us.index', [
      'setting' => $setting
    ]);
  }

  public function enquire()
  {
    return view('pages.user.enquire.index', [
      'adultArr' => Enquire::adultArr(),
      'childArr' => Enquire::childArr(),
    ]);
  }

  public function storeEnquire(StoreEnquire $request)
  {

    // dd($request);
    Enquire::create([
      'range' => $this->findRange($request),
      'adult_count' => $request['adult'],
      'child_count' => $request['child'],
      'description' => $request['description'],
      'first_name' => $request['first_name'],
      'email' => $request['email'],
      'phone_no' => $request['phone_no'],
      'audlt' => $request['audlt'],
      'status' => Enquire::STATUS_IN_RPOCESS,
    ]);
    return redirect(route('user.dashboard'));
  }


  public function findRange($request)
  {
    if ($request['range_1'])
      return $request['range_1'];
    else if ($request['range_2'])
      return $request['range_2'];
    else if ($request['range_3'])
      return $request['range_3'];
    else if ($request['range_4'])
      return $request['range_4'];
  }
}
