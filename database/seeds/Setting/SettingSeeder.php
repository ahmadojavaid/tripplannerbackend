<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('settings')->insert([
      [
        'slug' => "how-it-work-video",
        'value' => '/user/images/dummyVideo.mp4',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()

      ],
    ]);
  }
}
