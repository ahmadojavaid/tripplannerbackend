<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleAssociatedPlacesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('article_associated_places', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('place_id');
      $table->unsignedBigInteger('article_id');
      $table->softDeletes();
      $table->foreign('place_id')->references('id')->on('country_places');
      $table->foreign('article_id')->references('id')->on('user_articles');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('article_associated_places');
  }
}
