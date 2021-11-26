<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiresTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('enquires', function (Blueprint $table) {
      $table->id();
      $table->double('range');
      $table->unsignedTinyInteger('adult_count');
      $table->unsignedTinyInteger('child_count');
      $table->string('first_name');
      $table->string('email');
      $table->longText('description');
      $table->string('phone_no', 20);
      $table->unsignedTinyInteger('status');
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
    Schema::dropIfExists('enquires');
  }
}
