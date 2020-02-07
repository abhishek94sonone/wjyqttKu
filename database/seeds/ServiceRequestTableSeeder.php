<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceRequests;
use App\Models\VehicleModels;

class ServiceRequestTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(){
    for($i=0;$i<50;$i++){
      ServiceRequests::create($this->fakeRecord());
      gc_collect_cycles();
    }
  }
  public function fakeRecord(){
    $faker = Faker\Factory::create();
    $status = ['new','ready for pickup','waiting on parts','closed'];
    return [
        'client_name'      => $faker->name,
        'client_phone'     => $faker->phoneNumber,
        'client_email'     => $faker->unique()->safeEmail,
        'vehicle_model_id' => VehicleModels::all()->random(1)->first()->id,
        'status'           => $status[array_rand($status,1)],
        'updated_at'       => $faker->dateTimeBetween,
        'description'      => $faker->realText(180),
    ];
  }
}
