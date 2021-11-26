<?php

namespace App\Repositories\User\Article;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\ArticleTag;
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
   * @param int $paged
   * @param string $orderBy
   * @param string $sort
   *
   * @return mixed
   */
  public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
  {
    return $this->model
      ->where('status', User::STATUS_ACTIVE)
      ->orderBy($orderBy, $sort)
      ->paginate($paged);
  }
}
