<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class ModelRoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::$guard_name = "admin";
    User::find(1)->assignRole('admin');
    User::$guard_name = "web";
    User::find(2)->assignRole('user');
  }
}
