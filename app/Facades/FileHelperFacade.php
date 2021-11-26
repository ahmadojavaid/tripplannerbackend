<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FileHelperFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'fileHelper';
  }
}
