<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->string('name');
      $table->smallInteger('type');
      $table->softDeletes();
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
    Schema::dropIfExists('country_files');
  }
}
