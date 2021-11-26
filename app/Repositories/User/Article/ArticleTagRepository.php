<?php

namespace App\Repositories\Admin\Article;

use App\Models\ArticleTag;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class ArticleTagRepository.
 */
class ArticleTagRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return ArticleTag::class;
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleTag
   */
  public function create(array $data): ArticleTag
  {
    return DB::transaction(function () use ($data) {
      $articleTag = parent::create([
        'name' => $data['name'],
        'status' => $data['status'],
      ]);

      return $articleTag;

      throw new GeneralException(__('Error while creating user'));
    });
  }

  /**
   * @param ArticleTag  $articleTag
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleTag
   */
  public function update(ArticleTag $category, array $data): ArticleTag
  {

    return DB::transaction(function () use ($category, $data) {
      $category->update([
        'name' => $data['name'],
        'status' => $data['status'],

      ]);

      return $category;
      throw new GeneralException(__('Error while updating user'));
    });
  }



  /**
   * @param ArticleTag $category
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleTag
   */
  public function forceDelete(ArticleTag $category): ArticleTag
  {
    return DB::transaction(function () use ($category) {
      if ($category->delete()) {

        return $category;
      }

      throw new GeneralException(__('Error while delete category'));
    });
  }
}
