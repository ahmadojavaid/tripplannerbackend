<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trip_places', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_trip_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();
          $table->string('description')->nullable();

          $table->unsignedBigInteger('transport_id')->nullable();
          $table->string('transport_title')->nullable();
          $table->float('transport_price')->nullable();

          $table->unsignedBigInteger('no_of_nights')->nullable();
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
        Schema::dropIfExists('user_trip_places');
    }
}
