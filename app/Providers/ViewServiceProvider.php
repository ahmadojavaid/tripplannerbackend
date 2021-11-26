<?php

namespace App\Providers;

use App\Models\Country;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {

    // Using Closure based composers...
    View::composer(['panels.user.includes.destination', 'pages.user.dashboard.partials.destination'], function ($view) {
      $view->with(['countries' => Country::where('status', Country::STATUS_ACTIVE)->get()]);
    });


    // Using Closure based composers...
    View::composer(['panels.user.footer'], function ($view) {
      $view->with(['higlightedCountries' => Country::where([
        'status' => Country::STATUS_ACTIVE,
        'priority_status' => Country::PRIORITY_STATUS_HIGHLIGHTED
      ])->limit(5)->latest()->get()]);
    });
  }
}
