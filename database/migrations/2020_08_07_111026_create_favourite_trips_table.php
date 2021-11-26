<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteTripsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('favourite_trips', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('trip_id');
      $table->unsignedBigInteger('user_id');
      // $table->timestamps();
      $table->foreign('trip_id')->references('id')->on('trips');
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('favourite_trips');
  }
}
