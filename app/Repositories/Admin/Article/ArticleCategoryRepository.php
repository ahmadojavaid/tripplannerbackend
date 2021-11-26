<?php

namespace App\Repositories\Admin\Article;

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class ArticleCategoryRepository.
 */
class ArticleCategoryRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return ArticleCategory::class;
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleCategory
   */
  public function create(array $data): ArticleCategory
  {
    return DB::transaction(function () use ($data) {
      $articleCategory = parent::create([
        'name' => $data['name'],
        'status' => $data['status'],
      ]);

      return $articleCategory;

      throw new GeneralException(__('Error while creating user'));
    });
  }

  /**
   * @param ArticleCategory  $articleCategory
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleCategory
   */
  public function update(ArticleCategory $category, array $data): ArticleCategory
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
   * @param ArticleCategory $category
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return ArticleCategory
   */
  public function forceDelete(ArticleCategory $category): ArticleCategory
  {
    return DB::transaction(function () use ($category) {
      if ($category->delete()) {

        return $category;
      }

      throw new GeneralException(__('Error while delete category'));
    });
  }
}
