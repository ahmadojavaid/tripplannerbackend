<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Route\StoreRoute;
use App\Http\Requests\Admin\Route\UpdateRoute;
use App\Http\Requests\Admin\Trip\ManageTrip;
use App\Models\Country;
use App\Models\Route;
use App\Repositories\Admin\Trip\RouteRepository;
use Illuminate\Http\Request;

class RouteController extends Controller
{
  private $routeRepository;

  /**
   * RouteController constructor.
   *
   * @param RouteRepository $routeRepository
   */
  public function __construct(RouteRepository $routeRepository)
  {
    $this->routeRepository = $routeRepository;
  }


  public function index(ManageTrip $request)
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Trip Routes"]
    ];

    $routes =  $this->routeRepository->list();
    return view('pages.admin.trip.route.index', [
      'breadcrumbs' => $breadcrumbs,
      'routes' => $routes,
    ]);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips/routes", 'name' => "Route Trip Manager"], ['name' => "Create Route"]
    ];

    return view('pages.admin.trip.route.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => Route::getStatusArr(),
      'typeArr' => Route::getType(),
      'transportArr' => Route::getTransportation(),
      'countryArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
    ]);
  }

  public function store(StoreRoute $request)
  {
    $this->routeRepository->create($request->all(
      'country',
      'departure',
      'departure_type',
      'status',
      'destination',
      'destination_type',
      'transport_type',
      'price',
      'duration'
    ));

    return redirect()->route('admin.trip.route.index')->with('success', __('Route Created'));
  }


  public function edit(Route $route)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/trips/routes", 'name' => "Trip Route Manager"], ['name' => "Update Route Trip"]
    ];

    return view('pages.admin.trip.route.edit', [
      'breadcrumbs' => $breadcrumbs,
      'route' => $route,
      'statusArr' => Route::getStatusArr(),
      'typeArr' => Route::getType(),
      'transportArr' => Route::getTransportation(),
      'countryArr' => Country::where('status', Country::STATUS_ACTIVE)->pluck('name', 'id'),
    ]);
  }


  public function update(UpdateRoute $request, Route $route)
  {
    $this->routeRepository->update($route, $request->only(
      'country',
      'departure',
      'departure_type',
      'status',
      'destination',
      'destination_type',
      'transport_type',
      'price',
      'duration'
    ));

    return redirect()->route('admin.trip.route.index')->with('success', __('Route Updated'));
  }

  public function destroy()
  {
  }

  public function locations(Request $request)
  {
    $data = $this->routeRepository->locations($request->only('country', 'type', 'search'));
    return response()->json(['results' => $data]);
  }
}
