<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceAssociatedCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('experience_associated_categories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('experience_id');
      $table->unsignedBigInteger('category_id');
      $table->softDeletes();
      $table->foreign('experience_id')->references('id')->on('experiences');
      $table->foreign('category_id')->references('id')->on('experience_categories');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('experience_associated_categories');
  }
}
