<?php

namespace App\Http\Controllers\Admin\Enquire;

use App\Http\Controllers\Controller;
use App\Models\Enquire;

class EnquireController extends Controller
{


  // /**
  //  * EnquireController. constructor.
  //  *
  //  * @param CountryRepository $countryRepository
  //  */
  // public function __construct(CountryRepository $countryRepository, HotelRepository $hotelRepository)
  // {
  //   $this->countryRepository = $countryRepository;
  //   $this->hotelRepository = $hotelRepository;
  // }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Enquires"]
    ];

    $enquires =  Enquire::all();
    return view('pages.admin.enquire.index', [
      'enquires' => $enquires,
      'breadcrumbs' => $breadcrumbs
    ]);
  }


  public function show(Enquire $enquire)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/enquires/", 'name' => "Enquires"], ['name' => "Show"]
    ];

    return view('pages.admin.enquire.show', [
      'enquire' => $enquire,
      'breadcrumbs' => $breadcrumbs
    ]);
  }
}
