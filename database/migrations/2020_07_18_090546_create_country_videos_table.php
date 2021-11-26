<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryVideosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_videos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->string('title');
      $table->longText('description');
      $table->string('link_1');
      $table->string('link_2');
      $table->string('link_3');
      $table->softDeletes();
      $table->timestamps();
      $table->foreign('country_id')->references('id')->on('countries');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('country_videos');
  }
}
