<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('property_files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('property_id');
      $table->string('name', 50);
      $table->smallInteger('type');
      $table->softDeletes();
      $table->foreign('property_id')->references('id')->on('properties');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('property_files');
  }
}
