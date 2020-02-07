<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(){
    $this->call(VehicleMakeTableSeeder::class);
    $this->call(VehicleModelTableSeeder::class);
    $this->call(ServiceRequestTableSeeder::class);
  }
}
