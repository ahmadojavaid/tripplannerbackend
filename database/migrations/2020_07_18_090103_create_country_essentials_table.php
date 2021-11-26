<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryEssentialsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_essentials', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->longText('when_to_go');
      $table->longText('weather');
      $table->longText('getting_there');
      $table->longText('travel_expenses');
      $table->longText('culture');
      $table->softDeletes();
      $table->timestamps();
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
    Schema::dropIfExists('country_essentials');
  }
}
