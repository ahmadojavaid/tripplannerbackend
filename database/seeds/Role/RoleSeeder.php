<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('roles')->insert([
      [
        'name' => 'admin',
        'guard_name' => "admin",
      ],
      [
        'name' => 'user',
        'guard_name' => "web",
      ],
      [
        'name' => 'blog user',
        'guard_name' => "admin",
      ],
    ]);
  }
}
