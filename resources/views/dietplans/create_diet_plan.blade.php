@extends('layouts.default')

@push('styles')

@endpush

@section('title','Diet Plan')
@section('sub_title','Add Diet Plan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                            <form   action="{{route('create_diet_plan')}}" method="POST" class="login-form" id="create_workout_plan_form">
                                @csrf
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Diet Plan</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('diet_plan_name') has-danger @enderror">
                                                <label>Plan Name</label>
                                                <input class="form-control" placeholder="Enter a Name" type="text"
                                                    name="diet_plan_name" @if(!empty(old('diet_plan_name'))) value="{{old('diet_plan_name')}}" @else value="" @endif>
                                                @error('diet_plan_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_breakfast') has-danger @enderror">
                                                <label>Breakfast</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Breakfast" name="diet_plan_breakfast" id="diet_plan_breakfast" rows="3">@if(!empty(old('diet_plan_breakfast'))) {{old('diet_plan_breakfast')}}@elseif(isset($data['result'])) {{$data['result']->diet_plan_breakfast}}@else @endif</textarea>
                                                @error('diet_plan_breakfast')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_dinner') has-danger @enderror">
                                                <label>Dinner</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Dinner" name="diet_plan_dinner" id="diet_plan_dinner" rows="3">@if(!empty(old('diet_plan_dinner'))) {{old('diet_plan_dinner')}}@elseif(isset($data['result'])) {{$data['result']->diet_plan_dinner}} @else  @endif</textarea>
                                                @error('diet_plan_dinner')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group @error('diet_plan_bmi_category') has-danger @enderror">
                                                <label>BMI Category</label>
                                                <select class="form-control select2" name="diet_plan_bmi_category" id="diet_plan_bmi_category">
                                                    <option value="" label="Select a Category">
                                                    Select a Category
                                                    </option>
                                                    <option value="Underweight" label="Underweight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Underweight')) selected @endif>
                                                        Underweight
                                                    </option>
                                                    <option value="Normal weight" label="Normal weight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Normal weight')) selected @endif>
                                                        Normal weight
                                                    </option>
                                                    <option value="Overweight" label="Overweight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Overweight')) selected @endif>
                                                        Overweight
                                                    </option>
                                                    <option value="Obesity" label="Obesity" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Obesity')) selected @endif>
                                                        Obesity
                                                    </option>
                                                </select>
                                                @error('diet_plan_bmi_category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_lunch') has-danger @enderror">
                                                <label>Lunch</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Lunch" name="diet_plan_lunch" id="diet_plan_lunch" rows="3">@if(!empty(old('diet_plan_lunch'))) {{old('diet_plan_lunch')}}@elseif(isset($data['result'])) {{$data['result']->diet_plan_lunch}}@else @endif</textarea>
                                                @error('diet_plan_lunch')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                         </div>

                                        <div class="col-md-8">
                                            <div class="form-group @error('diet_plan_day') has-danger @enderror">
                                                <label>Select the Days</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input type="checkbox" value="yes" name="diet_day_monday"   {{ old('diet_day_monday') ? 'checked' : '' }}><span>Monday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input type="checkbox" value="yes" name="diet_day_tuesday"   {{ old('diet_day_tuesday') ? 'checked' : '' }}><span>Tuesday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_wednesday" {{ old('diet_day_wednesday') ? 'checked' : '' }}><span>Wednesday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_thursday" {{ old('diet_day_thursday') ? 'checked' : '' }}><span>Thursday</span></label>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_friday" {{ old('diet_day_friday') ? 'checked' : '' }}><span>Friday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_saturday" {{ old('diet_day_saturday') ? 'checked' : '' }}><span>Saturday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_sunday" {{ old('diet_day_sunday') ? 'checked' : '' }}><span>Sunday</span></label>
                                                    </div>
                                                </div>

                                                @error('diet_plan_day')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group @error('diet_plan_description') has-danger @enderror">
                                                <label>Description</label>
                                                    <textarea class="form-control" placeholder="Enter a Brief Description" name="diet_plan_description" id="diet_plan_description" rows="3">@if(!empty(old('diet_plan_description'))) {{old('diet_plan_description')}}@elseif(isset($data['result'])) {{$data['result']->diet_plan_description}}@else @endif</textarea>
                                                @error('diet_plan_description')
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
                                                    <button  type="submit" id="submit" class="btn btn-success">Add Diet Plan</button>
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
