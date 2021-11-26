<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPlacesNSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_places_n_s', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('trip_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();
          $table->string('description')->nullable();
          $table->softDeletes();
//          $table->unsignedBigInteger('transport_id')->nullable();
          $table->string('transport_title')->nullable();
//          $table->float('transport_price')->nullable();

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
        Schema::dropIfExists('trip_places_n_s');
    }
}
