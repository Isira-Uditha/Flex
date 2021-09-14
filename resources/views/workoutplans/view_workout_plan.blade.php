@extends('layouts.default')

@push('styles')

@endpush
@php
    $exercises = $data['exercises'];
@endphp

@section('title','Workout Plan')
@section('sub_title','View Workout Plan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                    <form action="{{route('create_workout_plan')}}" method="POST" class="login-form" id="create_workout_plan_form">
                        @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-3">{{$data['result']->workout_plan_name}}</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @error('workout_plan_name') has-danger @enderror">
                                    <label>Plan Name</label>
                                    <input class="form-control" placeholder="Enter a Name" type="text"
                                        name="workout_plan_name"  value="{{$data['result']->workout_plan_name}}" readonly>
                                    @error('workout_plan_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('workout_plan_bmi_category') has-danger @enderror">
                                    <label>BMI Category</label>
                                    <input class="form-control" placeholder="Enter a Name" type="text"
                                    name="workout_plan_bmi_category" value="{{$data['result']->workout_bmi_category}}" readonly>
                                    @error('workout_plan_bmi_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @error('workout_plan_duration') has-danger @enderror">
                                    <label>Duration (Number of Months)</label>
                                    <input class="form-control"type="text"
                                    name="workout_plan_duration" value="{{$data['result']->duration}}" readonly>
                                    @error('workout_plan_duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group @error('workout_plan_day') has-danger @enderror">
                                    <label>Select the Days</label>
                                    <div class="row">
                                        <div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_monday"   {{$data['result']->workout_monday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Monday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_tuesday"  {{ $data['result']->workout_tuesday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Tuesday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_wednesday"  {{ $data['result']->workout_wednesday == "yes" ? 'checked' : '' }} onclick="return false"><span>Wednesday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_thursday"  {{ $data['result']->workout_thursday == "yes" ? 'checked' : '' }} onclick="return false"><span>Thursday</span></label>
										</div>
                                        <br>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_friday"  {{ $data['result']->workout_friday == "yes" ? 'checked' : '' }} onclick="return false"><span>Friday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_saturday"  {{ $data['result']->workout_saturday == "yes" ? 'checked' : '' }} onclick="return false"><span>Saturday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_sunday" {{ $data['result']->workout_sunday == "yes" ? 'checked' : '' }} onclick="return false"><span>Sunday</span></label>
										</div>
									</div>
                                    @error('workout_plan_day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('workout_plan_exercises') has-danger @enderror">
                                    <label>Workout Exercises</label>

                                    <div class="listgroup-example ">
                                        <ul class="list-group">
                                        <ul class="list-style-disc">
                                    @foreach($exercises as $exercise)
										<div class="col-lg-3">
                                            <li>{{$exercise[0]->exercise_name}} </li>
											{{-- <input type="text" value="{{$exercise[0]->exercise_name}}" name="workout_plan_exercises[]"><span>{{$exercise[0]->exercise_name}}</span> --}}
										</div>

                                    @endforeach
                                        </ul>
                                        </ul>
                                    </div>

                                </div>
                                <div class="form-group @error('workout_plan_description') has-danger @enderror">
                                    <label>Description</label>
                                    <textarea class="form-control" placeholder="Enter a Brief Description" name="workout_plan_description" id="workout_plan_description" rows="3" readonly>
                                             {{$data['result']->workout_desc}}
                                    </textarea>

                                    @error('workout_plan_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer w-100" style="position: absolute; bottom: 0;">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <div class="form-group col-md-12">
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="form-group col-md-12">
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    $('#clear').click(function (e) {
    e.preventDefault();
    clear();
});

});

function clear(){
    $('.select2').val('');
    $('.select2').trigger('change');
    $('input[type=text]').val('');
    $('input[type=checkbox]').prop('checked',false);
    $('textarea').val('');
}

</script>
@endpush
