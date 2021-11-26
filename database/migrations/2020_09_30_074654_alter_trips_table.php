<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
          $table->date('end_date')->nullable()->after('photo');
          $table->date('start_date')->nullable()->after('photo');
          $table->string('route_map_photo', 50)->nullable()->after('photo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
          $table->dropColumn('route_map_photo');
          $table->dropColumn('start_date');
          $table->dropColumn('end_date');
        });
    }
}
