<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('place_files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('place_id');
      $table->string('name', 50);
      $table->smallInteger('type');
      $table->softDeletes();
      $table->foreign('place_id')->references('id')->on('country_places');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('place_files');
  }
}
