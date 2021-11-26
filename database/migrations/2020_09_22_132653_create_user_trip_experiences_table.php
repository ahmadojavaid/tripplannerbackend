<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trip_experiences', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_trip_id')->nullable();
          $table->unsignedBigInteger('experience_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();

          $table->float('experience_price')->nullable();
          $table->longText('description')->nullable();
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
        Schema::dropIfExists('user_trip_experiences');
    }
}
