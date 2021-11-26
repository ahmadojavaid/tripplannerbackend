<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_properties', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('trip_id')->nullable();
          $table->unsignedBigInteger('property_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();
          $table->softDeletes();
          $table->float('property_price')->nullable();
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
        Schema::dropIfExists('trip_properties');
    }
}
