<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMakes extends Model {
  protected $guarded = ['id'];

  public function vehiclemodels(){
  	return $this->hasMany(VehicleModels::class, 'vehicle_make_id', 'id');
  }
}
