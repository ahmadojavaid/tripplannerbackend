<?php

namespace App\Providers;

use App\Helpers\General\FileHelper;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
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
    $this->app->singleton('fileHelper', function ($app) {
      return new FileHelper();
    });
  }
}
