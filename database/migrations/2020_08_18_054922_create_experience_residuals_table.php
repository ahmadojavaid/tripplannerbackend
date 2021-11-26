<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceResidualsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('experience_residuals', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('experience_id');
      $table->string('slug');
      $table->longText('value');
      $table->timestamps();
      $table->softDeletes();
      $table->foreign('experience_id')->references('id')->on('experiences');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('experience_residuals');
  }
}
