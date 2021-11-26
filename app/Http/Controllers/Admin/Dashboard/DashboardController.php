<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{


  // public function __construct()
  // {
  //   $this->middleware('auth.admin:admin');
  // }

  public function index()
  {
    $pageConfigs = [
      'pageHeader' => false
    ];

    return view('/pages/admin/dashboard/dashboard', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}
