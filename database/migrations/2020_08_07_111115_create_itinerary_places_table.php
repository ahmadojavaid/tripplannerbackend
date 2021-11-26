<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryPlacesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('itinerary_places', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('itinerary_id');
      $table->unsignedBigInteger('place_id');
      // $table->timestamps();
      $table->foreign('itinerary_id')->references('id')->on('country_itineraries');
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
    Schema::dropIfExists('itinerary_places');
  }
}
