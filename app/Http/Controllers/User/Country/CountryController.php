<?php

namespace App\Http\Controllers\User\Country;

use App\Http\Controllers\Controller;


use App\Repositories\User\Article\ArticleCategoryRepository;
use App\Repositories\User\Article\UserArticleRepository;
use App\Repositories\User\Country\CountryRepository;

class CountryController extends Controller
{

  protected $countryRepository;
  /**
   * UserArticleControlle constructor.
   *
   * @param UserArticleRepository $userArticleRepository
   * @param ArticleCategoryRepository $articleCategoryRepository
   */
  public function __construct(CountryRepository $countryRepository)
  {
    $this->countryRepository = $countryRepository;
  }


  public function country($slug)
  {
    return view('pages.user.country.detail', [
      'country' => $this->countryRepository->country([
        'slug' => $slug
      ])
    ]);
  }
}
