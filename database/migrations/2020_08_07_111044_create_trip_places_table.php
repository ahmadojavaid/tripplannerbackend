<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPlacesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trip_places', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('trip_id');
      $table->unsignedBigInteger('place_id');
      $table->softDeletes();
      // $table->timestamps();
      $table->foreign('trip_id')->references('id')->on('trips');
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
    Schema::dropIfExists('trip_places');
  }
}
