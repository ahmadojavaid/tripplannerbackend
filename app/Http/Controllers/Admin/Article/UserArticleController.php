<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Article\User\StoreUserArticle;
use App\Http\Requests\Admin\Article\User\UpdateUserArticle;
use App\Repositories\Admin\Article\UserArticleRepository;
use App\Models\Country;
use App\Models\CountryPlace;
use App\Models\UserArticle;

class UserArticleController extends Controller
{

  protected $userArticleRepository;

  /**
   * UserArticleControlle constructor.
   *
   * @param UserArticleRepository $userArticleRepository
   */
  public function __construct(UserArticleRepository $userArticleRepository)
  {
    $this->userArticleRepository = $userArticleRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Articles"]
    ];
    $articles =  $this->userArticleRepository->list();
    return view('pages.admin.article.user.index', [
      'breadcrumbs' => $breadcrumbs,
      'articles' => $articles,
    ]);
  }


  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/articles", 'name' => "Articles"], ['name' => "Create Article"]
    ];

    return view('pages.admin.article.user.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => UserArticle::getStatusArr(),
      'priorityStatusArr' => UserArticle::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr(),
      'associatedCountries' =>  Country::getCountryArr(),
      'associatedPlaces' =>  CountryPlace::getPlaceArr(),

    ]);
  }

  public function store(StoreUserArticle $request)
  {
    $this->userArticleRepository->create($request->only(
      'country',
      'title',
      'sub_title',
      'description',
      'status',
      'priority_status',
      'photo',
      'description_images_container',
      'reading_time',
      'associatedCountries',
      'associatedPlaces'

    ));

    return redirect()->route('admin.article.user.index')->with('success', __('User Article created successfully'));
  }

  public function edit(UserArticle $article)
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/articles", 'name' => "Articles"], ['name' => "Update Article"]
    ];

    return view('pages.admin.article.user.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => UserArticle::getStatusArr(),
      'priorityStatusArr' => UserArticle::getPriorityStatusArr(),
      'countryArr' => Country::getCountryArr(),
      'article' => $article,
      'associatedCountries' =>  Country::getCountryArr(),
      'associatedPlaces' =>  CountryPlace::getPlaceArr(),

    ]);
  }


  public function update(UpdateUserArticle $request, UserArticle $article)
  {

    $this->userArticleRepository->update($article, $request->only(
      'country',
      'title',
      'sub_title',
      'description',
      'status',
      'priority_status',
      'photo',
      'description_images_container',
      'reading_time',
      'associatedCountries',
      'associatedPlaces'
    ));

    return redirect()->route('admin.article.user.index')->with('success', __('User Article updated successfully'));
  }


  public function destroy(int $id)
  {
    $deleteStatus = $this->userArticleRepository->deleteArticle($id);
    if($deleteStatus){
      return redirect()->back();
    }
    else{
      throw new Exception(__('Error while deleting article'));
    }
  }
}
