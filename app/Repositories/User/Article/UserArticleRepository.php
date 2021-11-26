<?php

namespace App\Repositories\User\Article;

use App\Models\UserArticle;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\UserArticleTag;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use FileHelper;


/**
 * Class UserArticleRepository.
 */
class UserArticleRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return UserArticle::class;
  }

  public function getPaginatedCategoryArticle(array $data)
  {
    return $this->model
      ->filterCountry($data['countryId'])
      ->where(['status' => UserArticle::STATUS_ACTIVE])
      ->paginate(15);
  }

  public function getRelatedArticles($data)
  {
    return $this->model->where([
      ['country_id', '=', $data['countryId']],
      ['id', '<>', $data['articleId']]
    ])->get();
  }

  public function article(array $data)
  {
    return $this->model
      ->with('createdBy', 'activeAssociatedCountries', 'activeAssociatedPlaces')
      ->withCount('activeAssociatedCountries as country_count', 'activeAssociatedPlaces as place_count')
      ->where(['slug' => $data['slug'], 'status' => UserArticle::STATUS_ACTIVE])
      ->first();
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return UserArticle
   */
  public function create(array $data): UserArticle
  {
    return DB::transaction(function () use ($data) {
      $article = parent::create([
        'title' => $data['title'],
        'sub_title' => $data['sub_title'],
        'description' => $data['description'],
        'category_id' => $data['category_id'],
        'status' => $data['status'],
        'priority_status' => $data['priority_status'],
        'photo' => $data['photo'],
        'created_by' => Auth::guard('admin')->user()->id
      ]);

      if ($article) {


        $tempSingleImg = FileHelper::getImageName($article->id, $data['photo']->getClientOriginalExtension(), 0, 'articles');
        $article->update([
          'photo' => $tempSingleImg['name']
        ]);
        FileHelper::upload($tempSingleImg['path'], File::get($data['photo']));

        $tags = [];
        foreach ($data['tags'] as $tag) {

          $tags[] = new UserArticleTag(['tag_id' => $tag]);
        }
        $article->userArticleTags()->saveMany($tags);
      }



      return $article;

      throw new GeneralException(__('Error while creating user'));
    });
  }

  /**
   * @param UserArticle  $articleCategory
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return UserArticle
   */
  public function update(UserArticle $article, array $data): UserArticle
  {

    return DB::transaction(function () use ($article, $data) {
      $article->update([
        'title' => $data['title'],
        'sub_title' => $data['sub_title'],
        'description' => $data['description'],
        'category_id' => $data['category_id'],
        'status' => $data['status'],
        'priority_status' => $data['priority_status'],
        // 'photo' => $data['photo'],
      ]);
      if (isset($data['photo'])) {
        $articleImage = parent::getFileName($article->id);
        FileHelper::deleteFile($article->id, $articleImage, 'articles');
        $tempSingleImage = FileHelper::getImageName($article->id, $data['phot']->getClientOriginalExtension(), 0, 'articles');
        $product->update([
          'photo' => $tempSingleImage['name']
        ]);
        FileHelper::upload($tempSingleImage['path'], File::get($data['photo']));
      }

      $article->userArticleTags()->delete();
      $tags = [];
      foreach ($data['tags'] as $tag) {

        $tags[] = new UserArticleTag(['tag_id' => $tag]);
      }
      $article->userArticleTags()->saveMany($tags);
      return $article;
      throw new GeneralException(__('Error while updating user'));
    });
  }



  /**
   * @param UserArticle $category
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return UserArticle
   */
  public function forceDelete(UserArticle $category): UserArticle
  {
    return DB::transaction(function () use ($category) {
      if ($category->delete()) {

        return $category;
      }

      throw new GeneralException(__('Error while deleting category'));
    });
  }
}
