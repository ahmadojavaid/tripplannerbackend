<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_experiences', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('trip_id')->nullable();
          $table->unsignedBigInteger('experience_id')->nullable();
          $table->unsignedBigInteger('place_id')->nullable();
          $table->string('title')->nullable();
          $table->softDeletes();
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
        Schema::dropIfExists('trip_experiences');
    }
}
