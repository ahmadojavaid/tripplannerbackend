<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalHotelsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('external_hotels', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('slug');
      $table->string('description');
      $table->string('link');
      $table->string('picture', 100);
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
    Schema::dropIfExists('external_hotels');
  }
}
