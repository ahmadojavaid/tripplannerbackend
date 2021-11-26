<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryPlacesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('country_places', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('country_id');
      $table->string('name');
      $table->string('short_code', 20);
      $table->string('slug');
      $table->longText('short_description');
      $table->double('latitude');
      $table->double('longitude');
      $table->unsignedTinyInteger('status');
      $table->string('instagram_tag', 50);
      $table->unsignedTinyInteger('type');
      $table->softDeletes();
      $table->unsignedTinyInteger('priority_status');
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
    Schema::dropIfExists('country_places');
  }
}
