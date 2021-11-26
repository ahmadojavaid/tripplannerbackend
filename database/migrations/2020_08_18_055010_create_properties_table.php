<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('properties', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('created_by');
      $table->unsignedBigInteger('place_id');
      $table->unsignedBigInteger('type_id');
      $table->string('external_id', 20)->nullable();
      $table->string('title');
      $table->string('slug');
      $table->longText('short_description');
      $table->double('price');
      $table->unsignedTinyInteger('status');
      $table->unsignedTinyInteger('priority_status');
      $table->double('latitude');
      $table->double('longitude');
      $table->softDeletes();
      $table->foreign('created_by')->references('id')->on('users');
      $table->foreign('place_id')->references('id')->on('country_places');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('properties');
  }
}
