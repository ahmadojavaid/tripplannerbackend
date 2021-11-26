<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trips', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('starting_country_id');
          $table->string('title');

          $table->string('slug')->nullable();

          $table->date('start_date');
          $table->date('end_date');
//          $table->unsignedBigInteger('no_of_nights')->nullable();
          $table->float('price');
            $table->softDeletes();
          $table->longText('description');
          $table->string('photo', 50);
          $table->smallInteger('category');
          $table->unsignedTinyInteger('status');
          $table->unsignedTinyInteger('priority_status');

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
        Schema::dropIfExists('user_trips');
    }
}
