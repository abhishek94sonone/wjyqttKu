<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(){
    Schema::create('service_requests', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('client_name');
      $table->string('client_phone');
      $table->string('client_email');
      $table->bigInteger('vehicle_model_id');
      $table->enum('status',['new','ready for pickup','waiting on parts','closed']);
      $table->text('description');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){
    Schema::dropIfExists('service_request');
  }
}
