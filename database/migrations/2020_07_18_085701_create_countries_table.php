<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('countries', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug');
      $table->longText('short_description');
      $table->double('latitude');
      $table->double('longitude');
      $table->softDeletes();
      $table->unsignedTinyInteger('status');
      $table->unsignedTinyInteger('priority_status');
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
    Schema::dropIfExists('countries');
  }
}
