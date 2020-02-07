<?php

use Illuminate\Database\Seeder;
use App\Models\VehicleMakes;
use App\Models\VehicleModels;

class VehicleModelTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    $vehicleMakes = VehicleMakes::all();
    $models = [
      [
        'make'  => 'Jeep',
        'model' => 'Wrangler'
      ],
      [
        'make'  => 'Jeep',
        'model' => 'Gladiator'
      ],
      [
        'make'  => 'Jeep',
        'model' => 'Cherokee'
      ],
      [
        'make'  => 'Ford',
        'model' => 'Ranger'
      ],
      [
        'make'  => 'Ford',
        'model' => 'Bronco'
      ],
      [
        'make'  => 'Ford',
        'model' => 'F-150'
      ],
    ];
    foreach($models AS $model){
      $v_id = $vehicleMakes->where('title',$model['make'])->first()->id;
      VehicleModels::firstOrCreate([
        'vehicle_make_id' => $v_id,
        'title'           => $model['model']
      ]);
    }
  }
}
