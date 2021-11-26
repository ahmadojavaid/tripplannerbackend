<?php

namespace App\Http\Controllers\Admin\Experience;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\StorePlaceFile;
use App\Models\Experience;
use App\Repositories\Admin\Experience\ExperienceFileRepository;
use Illuminate\Http\Request;


class ExperienceFileController extends Controller
{
  /**
   * ExperienceFileController constructor.
   *
   * @param ExperienceFileRepository $fileRepository
   */
  public function __construct(ExperienceFileRepository $fileRepository)
  {
    $this->fileRepository = $fileRepository;
  }


  public function upload(Experience $experience)
  {
    $data = $this->fileRepository->upload($experience);
    return response()->json($data);
  }


  public function store(StorePlaceFile $request, Experience $experience)
  {
    return $this->fileRepository->store($request->only('file'), $experience);
  }

  public function destroy(Request  $request, Experience $experience)
  {
    return $this->fileRepository->destroy($request->only('name'), $experience);
  }
}
