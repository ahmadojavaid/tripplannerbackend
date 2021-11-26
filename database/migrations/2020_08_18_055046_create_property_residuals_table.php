<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyResidualsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('property_residuals', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('property_id');
      $table->string('slug');
      $table->longText('value');
      $table->softDeletes();
      $table->timestamps();
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
    Schema::dropIfExists('property_residuals');
  }
}
