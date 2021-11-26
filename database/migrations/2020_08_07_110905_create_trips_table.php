<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trips', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('created_by');
      $table->unsignedBigInteger('country_id');
      $table->string('title');
      $table->string('slug');
      $table->float('price');
      $table->longText('description');
      $table->string('photo', 50);
      $table->smallInteger('category');
      $table->softDeletes();
      $table->unsignedTinyInteger('status');
      $table->unsignedTinyInteger('priority_status');
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
    Schema::dropIfExists('trips');
  }
}
