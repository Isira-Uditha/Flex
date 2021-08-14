@extends('layouts.default')

@push('styles')

@endpush

@section('title','Workout Plan')
@section('sub_title','Add Workout Plan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-1">Workout Plan</h6>
                    <form action="{{route('create_workout_plan')}}" method="POST" class="login-form" id="create_workout_plan_form">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">

                                <div class="form-group @error('workout_plan_name') has-danger @enderror">
                                    <label>Plan Name</label>
                                    <input class="form-control" placeholder="Enter a Name" type="text"
                                        name="workout_plan_name" @if(!empty(old('workout_plan_name'))) value="{{old('workout_plan_name')}}" @else value="" @endif>
                                    @error('workout_plan_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('workout_plan_bmi_category') has-danger @enderror">
                                    <label>BMI Category</label>
                                    <select class="form-control select2" name="workout_plan_bmi_category" id="workout_plan_bmi_category">
                                        <option value="" label="Select a Category">
                                           Select a Category
                                        </option>
                                        <option value="Underweight" label="Underweight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Underweight')) selected @endif>
                                            Underweight
                                        </option>
                                        <option value="Normal weight" label="Normal weight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Normal weight')) selected @endif>
                                            Normal weight
                                        </option>
                                        <option value="Overweight" label="Overweight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Overweight')) selected @endif>
                                            Overweight
                                        </option>
                                        <option value="Obesity" label="Obesity" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Obesity')) selected @endif>
                                            Obesity
                                        </option>
                                    </select>
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
                                    <select class="form-control select2" name="workout_plan_duration" id="workout_plan_duration">
                                        <option value="" label="Select the Number of Months">
                                           Select the Number of Months
                                        </option>

                                        <option value="1" label="1 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '1')) selected @endif>
                                          1 Month
                                        </option>
                                        <option value="2" label="2 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '2')) selected @endif>
                                            2 Months
                                        </option>
                                        <option value="3" label="3 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '3')) selected @endif>
                                            3 Months
                                        </option>
                                        <option value="4" label="4 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '4')) selected @endif>
                                            4 Months
                                        </option>
                                        <option value="5" label="5 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '5')) selected @endif>
                                            5 Months
                                        </option>
                                    </select>
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
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_monday"   {{ old('workout_day_monday') ? 'checked' : '' }}><span>Monday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_tuesday"  {{ old('workout_day_tuesday') ? 'checked' : '' }}><span>Tuesday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_wednesday"  {{ old('workout_day_wednesday') ? 'checked' : '' }}><span>Wednesday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_thursday"  {{ old('workout_day_thursday') ? 'checked' : '' }} ><span>Thursday</span></label>
										</div>
                                        <br>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_friday"  {{ old('workout_day_friday') ? 'checked' : '' }}><span>Friday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_saturday"  {{ old('workout_day_saturday') ? 'checked' : '' }}><span>Saturday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_sunday" {{ old('workout_day_sunday') ? 'checked' : '' }} ><span>Sunday</span></label>
										</div>
									</div>

                                    @error('workout_plan_day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('workout_plan_exercises') has-danger @enderror">
                                    <label>Select Workout Exercises</label>

                                    @foreach($exercises as $exercise)
										<div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="{{$exercise->exercise_id}}" name="workout_plan_exercises[]"><span>{{$exercise->exercise_name}}</span></label>
										</div>
                                        <br>
                                    @endforeach
                                    @error('workout_plan_exercises')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('workout_plan_description') has-danger @enderror">
                                    <label>Description</label>
                                        <textarea class="form-control" placeholder="Enter a Brief Description" name="workout_plan_description" id="workout_plan_description" rows="3"></textarea>
                                    @error('workout_plan_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0">Add Workout Plan</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection



@push('scripts')
<script>
$(document).ready(function () {




});
</script>
@endpush
