@extends('layouts.main')
@push('scripts')
<script type="text/javascript">
	$(function(){
		let old_model_id = $('#service_store #old_model').val();
		old_model_id = (old_model_id=='')? "{{$serviceRequest->vehicle_model_id}}":old_model_id;
		$(document).on('change', '#service_store select#make', function(){
			let selectedMake = $(this).val();
			if(selectedMake!=''){
				$.ajax({
					url:"{{route('getModel')}}",
					data:{"_token": $("[name='csrf-token']").attr('content'), "vehicle_make_id":selectedMake},
					type:"POST",
					dataType:"json",
					success:function(result){
						if(result.hasOwnProperty("models")){
							$("#service_store select#model option:gt(0)").remove()
							for(key in result.models){
								let model_options = "<option value='"+key+"' "+((old_model_id==key)? 'selected':'')+">"+result.models[key]+"</option>"
								$("#service_store select#model").append(model_options);
							}
						}
					}
				})
			}else{
				$("#service_store select#model option:gt(0)").remove()
			}
		});
		if(old_model_id!='' && old_model_id>0){
			$('#service_store select#make').trigger('change');
		}
	});
</script>
@endpush
@section('content')
<section class="bg-light">
	<div class="text-center">
		<h2>Create Ticket</h2>
	</div>
	<div class="container">
		<form id="service_store" method="post" action="/service/{{$serviceRequest->id}}">
			@csrf
			@method('put')
			<div class="form-group">
				<label for="make">Vehicle Make:</label>
				<select class="form-control @error('vehicle_make_id') border-danger @enderror" id="make" name="vehicle_make_id" >
					<option value="">Select Vehicle Make</option>
					@php
					$old_make_id = (old("vehicle_make_id")!='')? old("vehicle_make_id"):$make_id;
					@endphp
					@foreach($makes as $make)
					<option value="{{$make->id}}" {{($old_make_id==$make->id)? 'selected': ''}}>
						{{$make->title}}
					</option>
					@endforeach
				</select>
				@error('vehicle_make_id')
					<p class="text-danger">{{$errors->first('vehicle_make_id')}}</p>
				@enderror
			</div>

			<div class="form-group">
				<label for="model">Vehicle Model:</label>
				<input type="hidden" id="old_model" value="{{old('vehicle_model_id')}}">
				<select class="form-control @error('vehicle_model_id') border-danger @enderror" id="model" name="vehicle_model_id" >
					<option value="">Select Vehicle Model</option>
				</select>
				@error('vehicle_model_id')
					<p class="text-danger">{{$errors->first('vehicle_model_id')}}</p>
				@enderror
			</div>
			
			<div class="form-group">
				<label for="client_name">Name:</label>
				<input class="form-control @error('client_name') border-danger @enderror" type="text" id="client_name" name="client_name" 
				value="{{((old('client_name')!='')? old('client_name'):$serviceRequest->client_name)}}">
				@error('client_name')
					<p class="text-danger">{{$errors->first('client_name')}}</p>
				@enderror
			</div>
			
			<div class="form-group">
				<label for="client_phone">Phone:</label>
				<input class="form-control @error('client_phone') border-danger @enderror" type="tel" id="client_phone" name="client_phone" pattern="\+?[0-9]{0,3}[0-9]{10}" value="{{((old('client_phone')!='')? old('client_phone'):$serviceRequest->client_phone)}}" >
				@error('client_phone')
					<p class="text-danger">{{$errors->first('client_phone')}}</p>
				@enderror
			</div>
			
			<div class="form-group">
				<label for="client_email">Email:</label>
				<input class="form-control @error('client_email') border-danger @enderror" type="email" id="client_email" name="client_email" value="{{((old('client_email')!='')? old('client_email'):$serviceRequest->client_email)}}" >
				@error('client_email')
					<p class="text-danger">{{$errors->first('client_email')}}</p>
				@enderror
			</div>
			
			<div class="form-group">
				<label for="description">Service Description:</label>
				<textarea class="form-control @error('description') border-danger @enderror" id="description" name="description" rows="4" cols="50" >{{((old('description')!='')? old('description'):$serviceRequest->description)}}</textarea>
				@error('description')
					<p class="text-danger">{{$errors->first('description')}}</p>
				@enderror
			</div>

			<input type="submit" class="btn btn-primary" value="Submit">
		</form>
	</div>
</section>
@endsection