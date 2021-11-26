<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryItinerariesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_itineraries', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->unsignedBigInteger('created_by');
      $table->string('title');
      $table->string('slug');
      $table->longText('description');
      $table->string('photo');
      $table->smallInteger('status');
      $table->smallInteger('priority_status');
      $table->double('latitude');
      $table->double('longitude');
      $table->softDeletes();
      $table->timestamps();
      $table->foreign('country_id')->references('id')->on('countries');
      $table->foreign('created_by')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('country_itineraries');
  }
}
