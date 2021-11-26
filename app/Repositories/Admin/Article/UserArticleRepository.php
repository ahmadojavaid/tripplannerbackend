<?php

namespace App\Repositories\Admin\Article;

use App\Models\ArticleAssociatedCountry;
use App\Models\ArticleAssociatedPlace;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Events\Admin\Blog\BlogCreated;
use App\Events\Admin\Blog\BlogStatus;
use App\Events\Admin\Blog\BlogUpdated;

use App\Models\ExternalHotel;
use App\Models\UserArticle;
use App\Repositories\BaseRepository;

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

  /**

   * @return mixed
   */
  public function list()
  {
    return $this->model->get();
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
      $user = Auth::guard('admin')->user();
      $article = parent::create([
        'title' => $data['title'],
        'sub_title' => $data['sub_title'],
        'description' => 'dummy',
        'country_id' => $data['country'],
        'status' => isset($data['status']) ? $data['status'] : UserArticle::STATUS_IN_ACTIVE,
        'priority_status' => isset($data['priority_status']) ? $data['priority_status'] : UserArticle::PRIORITY_STATUS_NORMAL,
        'photo' => 'temp',
        'reading_time' => $data['reading_time'],
        'created_by' => $user->id,
      ]);

      if ($article) {
        $article->storeFile($data['photo']);

        //handle article editor images upload
        $article->handleImagesUpload($data['description_images_container'],  $data['description']);

        // $article->userArticleTags()->saveMany(ArticleTag::syncTags($data['tags']));
        $article->articleAssociatedCountries()->saveMany(UserArticle::syncAssociatedCountries($data['associatedCountries']));

        $article->articleAssociatedPlaces()->saveMany(UserArticle::syncAssociatedPlaces($data['associatedPlaces']));


        if ($user->isBlogUser())
          event(new BlogCreated());

        return $article;
      }
      throw new Exception(__('Error while creating user article'));
    });
  }

  /**
   * @param UserArticle  $articleCategory
   * @param array $data
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return UserArticle
   */
  public function update(UserArticle $article, array $data): UserArticle
  {

    return DB::transaction(function () use ($article, $data) {
      $user = Auth::guard('admin')->user();

      $article->update([
        'title' => $data['title'],
        'sub_title' => $data['sub_title'],
        'country_id' => $data['country'],
        'status' => isset($data['status']) ? $data['status'] : UserArticle::STATUS_IN_ACTIVE,
        'priority_status' => isset($data['priority_status']) ? $data['priority_status'] : UserArticle::PRIORITY_STATUS_NORMAL,
        'reading_time' => $data['reading_time'],
      ]);


      if (isset($data['photo']))
        $article->updateFile($data['photo']);

      //handle article editor images
      $article->handleImagesUpload($data['description_images_container'], $data['description']);
      $this->handleDeleteImages($article->description,  $article->id);


      // $article->userArticleTags()->delete();

      $article->articleAssociatedCountries()->delete();
      $article->articleAssociatedPlaces()->delete();

      $article->articleAssociatedCountries()->saveMany(UserArticle::syncAssociatedCountries($data['associatedCountries']));
      $article->articleAssociatedPlaces()->saveMany(UserArticle::syncAssociatedPlaces($data['associatedPlaces']));

      // $article->userArticleTags()->saveMany(ArticleTag::syncTags($data['tags']));


      if ($user->isBlogUser())
        event(new BlogUpdated());
      else if ($article->createdBy->isBlogUser())
        event(new BlogStatus($article));

      return $article;
      throw new Exception(__('Error while updating user article'));
    });
  }



  /**
   * @param UserArticle $category
   *
   * @throws Exception
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

      throw new Exception(__('Error while deleting category'));
    });
  }

  public function handleDeleteImages($description, $id)
  {

    preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $description, $images);
    if (count($images[3]) === 0)
      return;

    $files = \File::allFiles(public_path('/storage/articles/' . $id . '/editor'));

    foreach ($files as $key => $value) {

      $fileName = $value->getFileName();
      $exist = false;
      foreach ($images[3] as $path) {
        $exist = str_contains($path, $fileName);
        if ($exist)
          break;
      }

      if (!$exist) {
        $filePath = \FileHelper::generateImagePath($id . '/editor', $fileName, 'articles');
        \FileHelper::deleteFile($filePath);
      }
    }
  }


  public function storeExternalHotel(array $data)
  {
    return DB::transaction(function () use ($data) {
      $externalHotel = ExternalHotel::create([
        'title' => $data["title"],
        'description' => $data["description"],
        "picture" => "temp",
        "link" => $data['link']
      ]);

      if ($externalHotel) {
        $externalHotel->storeBase64File($data['picture'], 'id',  'picture');
        return $externalHotel;
      }

      return $externalHotel;
      throw new Exception(__('Error while adding external hotel'));
    });
  }
  /**
   * @param int $id
   * @return bool
   */
  public function deleteArticle(int $id){
    $articleDeleted = UserArticle::findorFail($id)->delete();
    if($articleDeleted){
      return true;
    }
    else{
      return false;
    }
  }

}
