<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      [
        'first_name' => 'Admin',
        'last_name' => 'User',
        'email' => "admin@gmail.com",
        'phone_no' => "123456789",
        'password' => Hash::make('123456789'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()

      ],
      [
        'first_name' => 'Simple',
        'last_name' => 'User',
        'email' => "user@gmail.com",
        'phone_no' => "123456789",
        'password' => Hash::make('123456789'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]
    ]);
  }
}
