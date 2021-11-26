<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {

    view()->composer('*', function ($view) {

      $user = auth()->guard('admin')->user();

      if ($user) {

        if ($user->isAdmin())
          $verticalMenuJson = file_get_contents(base_path('resources/json/admin/verticalMenu.json'));
        else if ($user->isBlogUser())
          $verticalMenuJson = file_get_contents(base_path('resources/json/blog-user/verticalMenu.json'));

        $verticalMenuData = json_decode($verticalMenuJson);
        $horizontalMenuJson = file_get_contents(base_path('resources/json/horizontalMenu.json'));
        $horizontalMenuData = json_decode($horizontalMenuJson);



        // $cart = Cart::where('user_id', Auth::user()->id);

        //...with this variable
        $view->with('menuData', [$verticalMenuData, $horizontalMenuData]);
      }
    });
  }
}
