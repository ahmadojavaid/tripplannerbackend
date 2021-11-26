<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExternalHotel\StoreExternalHotel;
use App\Repositories\Admin\Article\UserArticleRepository;

class HotelController extends Controller
{

  protected $articleRepository;

  /**
   * HotelController constructor.
   *
   * @param UserArticleRepository $articleRepository
   */
  public function __construct(
    UserArticleRepository $articleRepository
  ) {
    $this->articleRepository = $articleRepository;
  }


  public function storeExternalHotel(StoreExternalHotel $request)
  {
    $data = $this->articleRepository->storeExternalHotel($request->all());
    $data = $data->toArray();
    return response()->json($data);
  }
}
