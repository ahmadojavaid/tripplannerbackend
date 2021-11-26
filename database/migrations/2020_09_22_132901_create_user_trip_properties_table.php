<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trip_properties', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_trip_id')->nullable();
          $table->unsignedBigInteger('property_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();

          $table->unsignedBigInteger('property_type_id')->nullable();
          $table->string('property_type_name')->nullable();
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
        Schema::dropIfExists('user_trip_properties');
    }
}
