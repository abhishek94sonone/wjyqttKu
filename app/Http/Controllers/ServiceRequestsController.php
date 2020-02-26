<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequests;
use App\Models\VehicleMakes;
use App\Models\VehicleModels;

class ServiceRequestsController extends Controller {

  /**
   * [Display a paginated list of Service Requests in the system]
   * @return view
   */
  public function index(){
    $requests = ServiceRequests::orderBy('updated_at','desc')->paginate(20);
    return view('index',compact('requests'));
  }
  /**
   * [This is the method you should use to show the edit screen]
   * @param  ServiceRequests $serviceRequest [get the object you are planning on editing]
   * @return ...
   */
  public function edit(ServiceRequests $serviceRequest){
    $makes = VehicleMakes::orderBy('updated_at','desc')->get();
    $make = VehicleModels::where("id",$serviceRequest->vehicle_model_id)->pluck('vehicle_make_id');
    $make_id = (count($make)>0)? $make[0]:0;
    return view('service.edit', compact('serviceRequest','make_id','makes'));
  }

  public function update(ServiceRequests $serviceRequest){
    $serviceRequest->update($this->validateService());
    return redirect(route('home'));
  }

  public function destroy(ServiceRequests $serviceRequest){
    $serviceRequest->delete();
    return redirect(route('home'));
  }

  public function create(){
    $makes = VehicleMakes::orderBy('updated_at','desc')->get();
    return view('service.create',compact('makes'));
  }

  public function store(){
    $this->validateService();
    $service = new ServiceRequests(request(['client_name','client_phone','client_email','vehicle_model_id','description']));
    $service->status = "new";
    $service->save();
    return redirect(route('home'));
  }

  public function getModel(Request $make){
    $models=VehicleMakes::find($make->post('vehicle_make_id'))->vehiclemodels->pluck('title','id');
    return response()->json(["models"=>$models]);
  }

  public function validateService(){
    return request()->validate([
      'vehicle_make_id' => 'required|exists:vehicle_makes,id',
      'vehicle_model_id' => 'required|exists:vehicle_models,id',
      'client_name' => 'required',
      'client_phone' => 'required|regex:/^\+?[0-9]{0,3}[0-9]{10}$/',
      'client_email' => 'required|email',
      'description' => 'required|min:15'
    ]);
  }
}
