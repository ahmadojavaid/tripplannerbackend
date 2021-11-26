<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Helpers\General\AmadeusHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Route\StoreAirportRoute;
use App\Http\Requests\Admin\Route\UpdateAirportRoute;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\Route;
use App\Repositories\Admin\Trip\RouteRepository;
use Session;

class AirportRouteController extends Controller
{
  private $routeRepository;

  /**
   * RouteController constructor.
   *
   * @param AirportRouteController $routeRepository
   */
  public function __construct(RouteRepository $routeRepository)
  {
    $this->routeRepository = $routeRepository;
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips/routes", 'name' => "Route Trip Manager"], ['name' => "Create Route"]
    ];

    return view('pages.admin.trip.route.airport.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Route::getStatusArr(),
      'countryArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
    ]);
  }

  public function store(StoreAirportRoute $request)
  {
    //need to optimize the working
    $departure = CountryPlace::where(['id' => $request->departure, 'type' => CountryPlace::TYPE_AIRPORT])->first();
    $destinaion = CountryPlace::where(['id' => $request->destination, 'type' => CountryPlace::TYPE_AIRPORT])->first();

    $airline = (new AmadeusHelper())->getAirlinePrice($departure->short_code, $destinaion->short_code);



    $price = $airline['data'][0]['price']['total'] ?? null;
    if (!$price)
      return back()->with('no-data', "No Data Found");


    $this->routeRepository->storeAirport(
      [
        'departure_country' => $request['departure_country'],
        'destination_country' => $request['destination_country'],
        'status' => $request['status'],
        'destination' => $request['destination'],
        'departure' => $request['departure'],
        'price' => $price,
        'duration' => $request['duration']
      ]
    );

    return redirect()->route('admin.trip.route.index')->with('success', __('Airport route is created'));
  }


  public function edit(Route $route)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips/routes", 'name' => "Trip Route Manager"], ['name' => "Update Route Trip"]
    ];

    return view('pages.admin.trip.route.airport.edit', [
      'breadcrumbs' => $breadcrumbs,
      'route' => $route,
      'statusArr' => Route::getStatusArr(),
      'countryArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
    ]);
  }


  public function update(UpdateAirportRoute $request, Route $route)
  {
    $this->routeRepository->updateAirport($route, $request->only(
      'status'
    ));

    return redirect()->route('admin.trip.route.index')->with('success', __('Airport route is updated'));
  }
}
