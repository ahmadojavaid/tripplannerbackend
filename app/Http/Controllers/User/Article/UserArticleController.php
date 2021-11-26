<?php

namespace App\Http\Controllers\User\Article;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Article\User\StoreUserArticle;
use App\Http\Requests\Admin\Article\User\UpdateUserArticle;
use App\Models\ExternalHotel;
use App\Models\UserArticle;
use App\Repositories\User\Article\UserArticleRepository;
use App\Repositories\User\Country\CountryRepository;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
  protected $articleRepository, $countrRepository;

  /**
   * UserArticleControlle constructor.
   *
   * @param UserArticleRepository $articleRepository
   * @param CountryRepository $countrRepository
   */
  public function __construct(UserArticleRepository $articleRepository, CountryRepository $countrRepository)
  {
    $this->articleRepository = $articleRepository;
    $this->countrRepository = $countrRepository;
  }


  public function index()
  {

    return view('pages.user.article.user.index', [
      'countries' => $this->countrRepository->list()
    ]);
  }

  public function article($slug)
  {
    $article = $this->articleRepository->article([
      'slug' => $slug
    ]);

    // dd($article);

    $relatedArticles = $this->articleRepository->getRelatedArticles([
      'countryId' => $article->country_id,
      'articleId' => $article->id
    ]);

    return view('pages.user.article.user.article', [
      'article' => $article,
      'relatedArticles' => $relatedArticles
    ]);
  }

  public function countryArticle(Request $request)
  {
    $data = $this->articleRepository->getPaginatedCategoryArticle($request->only('countryId'));
    return view('pages.user.article.user.partials.category_articles', compact('data'))->render();
  }


  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/articles/categories/", 'name' => "Article Categories"], ['name' => "Create Article Category"]
    ];

    return view('pages.admin.article.user.create', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => UserArticle::getStatusArr(),
      'priorityStatusArr' => UserArticle::getPriorityStatusArr(),
    ]);
  }

  public function store(StoreUserArticle $request)
  {
    $this->articleRepository->create($request->only(
      'category_id',
      'title',
      'sub_title',
      'description',
      'status',
      'priority_status',
      'tags',
      'photo',
    ));

    return redirect()->route('admin.article.user.index')->withFlashSuccess(__('alerts.backend.artilce.user.created'));
  }

  public function edit(UserArticle $article)
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/articles/categories/", 'name' => "Article Categories"], ['name' => "Update Article Category"]
    ];

    return view('pages.admin.article.user.edit', [
      'breadcrumbs' => $breadcrumbs,
      'statusArr' => UserArticle::getStatusArr(),
      'priorityStatusArr' => UserArticle::getPriorityStausArr(),
      'article' => $article
    ]);
  }


  public function update(UpdateUserArticle $request, UserArticle $article)
  {
    $this->articleRepository->update($article, $request->only(
      'category_id',
      'title',
      'sub_title',
      'description',
      'status',
      'priority_status',
      'tags',
      'photo',
    ));

    return redirect()->route('admin.article.user.index')->withFlashSuccess(__('alerts.backend.artilce.user.updated'));
  }


  public function destroy()
  {

  }

  public function externalHotels(Request $request)
  {

    $externalHotels = ExternalHotel::whereIn('slug', $request->data)->get();
    $data = [];
    foreach ($externalHotels as $key => $value) {
      array_push($data, [
        'id' => $value->id,
        'slug' => $value->slug,
        'title' => $value->title,
        'description' => $value->description,
        'link' => $value->link,
        'picture' => $value->getFile()
      ]);
    }

    return response()->json($data, 200);
  }
}
