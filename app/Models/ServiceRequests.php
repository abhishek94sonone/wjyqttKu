<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequests extends Model {
  use SoftDeletes;
  protected $guarded = ['id'];
  protected $fillable = ['client_name','client_phone','client_email','vehicle_model_id','description'];
}
