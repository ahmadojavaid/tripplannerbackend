<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserArticlesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_articles', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->unsignedBigInteger('created_by');
      $table->string('title');
      $table->string('slug');
      $table->string('sub_title');
      $table->longText('description');
      $table->string('photo', 50);
      $table->unsignedTinyInteger('status');
      $table->softDeletes();
      $table->unsignedTinyInteger('priority_status');
      $table->string('reading_time', 20);
      $table->timestamps();

      $table->foreign('country_id')->references('id')->on('countries');
      $table->foreign('created_by')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_articles');
  }
}
