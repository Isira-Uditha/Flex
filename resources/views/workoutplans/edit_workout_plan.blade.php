@extends('layouts.default')

@push('styles')

@endpush
@php
    $exercises = $data['exercises'];
    $uncheckExercises =   $data['unchekedExercises'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
@endphp

@section('title','Workout Plan')
@section('sub_title','Edit Workout Plan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                    <form action="{{route('workout_plan_update',['id' => $id])}}"  method="POST" class="login-form" id="update_workout_plan_form">
                        @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-3">{{$data['result']->workout_plan_name}}</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @error('workout_plan_name') has-danger @enderror">
                                    <label>Plan Name</label>
                                    <input class="form-control" placeholder="Enter a Name" type="text"
                                    name="workout_plan_name_pld"  value="{{$data['result']->workout_plan_name}}"  hidden>
                                        <input class="form-control" name="workout_plan_name" id="workout_plan_name" placeholder="Enter a Name"  type="text"
                                        @if(!empty(old('workout_plan_name'))) value="{{old('equiworkout_plan_namepment_name')}}" @else value="{{$data['result']->workout_plan_name}}" @endif>
                                        @error('workout_plan_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('workout_plan_bmi_category') has-danger @enderror">
                                    <label>BMI Category</label>
                                    <select class="form-control select2" name="workout_plan_bmi_category" id="workout_plan_bmi_category">
                                        <option value="Select a Category" label="Select a Category">
                                           Select a Category
                                        </option>
                                        <option value="Underweight" label="Underweight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Underweight')) selected @elseif(isset($data['result']) && $data['result']->workout_bmi_category ==  "Underweight") selected @endif>
                                            Underweight
                                        </option>
                                        <option value="Normal weight" label="Normal weight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Normal weight')) selected  @elseif(isset($data['result']) && $data['result']->workout_bmi_category ==  "Normal weight") selected @endif>
                                            Normal weight
                                        </option>
                                        <option value="Overweight" label="Overweight" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Overweight')) selected @elseif(isset($data['result']) && $data['result']->workout_bmi_category ==  "Overweight") selected @endif>
                                            Overweight
                                        </option>
                                        <option value="Obesity" label="Obesity" @if(!empty(old('workout_plan_bmi_category') && old('workout_plan_bmi_category') == 'Obesity')) selected  @elseif(isset($data['result']) && $data['result']->workout_bmi_category ==  "Obesity") selected @endif>
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
                                        <option value="Select the Number of Months" label="Select the Number of Months">
                                           Select the Number of Months
                                        </option>
                                        <option value="1" label="1 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '1')) selected  @elseif (isset($data['result']) && $data['result']->duration ==  "1") selected  @endif>
                                          1 Month
                                        </option>
                                        <option value="2" label="2 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '2')) selected @elseif (isset($data['result']) && $data['result']->duration ==  "2") selected  @endif>
                                            2 Months
                                        </option>
                                        <option value="3" label="3 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '3')) selected @elseif (isset($data['result']) && $data['result']->duration ==  "3") selected @endif>
                                            3 Months
                                        </option>
                                        <option value="4" label="4 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '4')) selected @elseif (isset($data['result']) && $data['result']->duration ==  "4") selected @endif>
                                            4 Months
                                        </option>
                                        <option value="5" label="5 Month" @if(!empty(old('workout_plan_duration') && old('workout_plan_duration') == '5')) selected @elseif (isset($data['result']) && $data['result']->duration ==  "5") selected @endif>
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
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_monday"   {{$data['result']->workout_monday == "yes"  ? 'checked' : '' }} ><span>Monday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="yes" name="workout_day_tuesday"  {{ $data['result']->workout_tuesday == "yes"  ? 'checked' : '' }} ><span>Tuesday</span></label>
										</div>
										<div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_wednesday"  {{ $data['result']->workout_wednesday == "yes" ? 'checked' : '' }} ><span>Wednesday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_thursday"  {{ $data['result']->workout_thursday == "yes" ? 'checked' : '' }}><span>Thursday</span></label>
										</div>
                                        <br>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_friday"  {{ $data['result']->workout_friday == "yes" ? 'checked' : '' }}><span>Friday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_saturday"  {{ $data['result']->workout_saturday == "yes" ? 'checked' : '' }} ><span>Saturday</span></label>
										</div>
                                        <div class="col-lg-3">
											<label class="ckbox"><input  type="checkbox" value="yes" name="workout_day_sunday" {{ $data['result']->workout_sunday == "yes" ? 'checked' : '' }} ><span>Sunday</span></label>
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
                                    @foreach( $exercises as $exercise)
										<div class="col-lg-3">
											<label class="ckbox"><input type="checkbox" value="{{$exercise[0]->exercise_id}}" name="workout_plan_exercises[]" checked><span>{{$exercise[0]->exercise_name}}</span></label>
										</div>
                                        <br>
                                    @endforeach
                                    @foreach( $uncheckExercises as $exercise)
                                    <div class="col-lg-3">
                                        <label class="ckbox"><input type="checkbox" value="{{$exercise->exercise_id}}" name="workout_plan_exercises[]" ><span>{{$exercise->exercise_name}}</span></label>
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
                                    <textarea class="form-control" placeholder="Enter a Brief Description" name="workout_plan_description" id="workout_plan_description" rows="3">@if(!empty(old('workout_plan_description'))) {{old('workout_plan_description')}} @else {{$data['result']->workout_desc}} @endif</textarea>
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
                                    <button  type="submit" id="save" class="btn btn-success">Update</button>
                                    <button type="button" id="clear" class="btn btn-secondary text-white" >Clear</button>
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
