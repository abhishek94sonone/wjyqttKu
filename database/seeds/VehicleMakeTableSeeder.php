<?php

use Illuminate\Database\Seeder;
use App\Models\VehicleMakes;

class VehicleMakeTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $models = ['Jeep','Ford'];
    foreach($models AS $model){
      VehicleMakes::firstOrCreate([
        'title'=> $model
      ]);
    }
  }
}
