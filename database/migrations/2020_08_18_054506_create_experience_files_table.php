<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('experience_files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('experience_id');
      $table->string('name', 50);
      $table->smallInteger('type');
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
    Schema::dropIfExists('experience_files');
  }
}
