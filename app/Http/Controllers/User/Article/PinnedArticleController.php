<?php

namespace App\Http\Controllers\User\Article;

use App\Http\Controllers\Controller;
use App\Models\PinnedArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinnedArticleController extends Controller
{

  public function handlePin(Request $request)
  {
    $article = PinnedArticle::where(['user_id' => Auth::guard('web')->user()->id, 'article_id' => $request->id])->first();
    if ($article) {
      $article = $article->delete();
      $status = 'deleted';
    } else {
      $article = PinnedArticle::create(['user_id' => Auth::guard('web')->user()->id, 'article_id' => $request->id]);
      $status = 'pinned';
    }
    return response()->json($status, 200);
  }
}
