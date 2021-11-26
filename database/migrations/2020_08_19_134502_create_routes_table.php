<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('routes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('departure_country_id');
      $table->unsignedBigInteger('destination_country_id');
      $table->unsignedBigInteger('departure_id');
      $table->smallInteger('departure_type');
      $table->unsignedBigInteger('destination_id');
      $table->smallInteger('destination_type');
      $table->smallInteger('transport_type');
      $table->smallInteger('status');
      $table->string('duration', 50);
      $table->double('price');
      $table->timestamps();

      $table->foreign('departure_country_id')->references('id')->on('countries');
      $table->foreign('destination_country_id')->references('id')->on('countries');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('routes');
  }
}
