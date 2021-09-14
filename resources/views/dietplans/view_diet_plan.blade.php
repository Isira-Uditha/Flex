@extends('layouts.default')

@push('styles')

@endpush

@section('title','Diet Plan')
@section('sub_title','View Diet Plan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                            <form   action="{{route('create_diet_plan')}}" method="POST" class="login-form" id="create_workout_plan_form">
                                @csrf
                                <div class="card-body">
                                    <h6 class="card-title mb-3">{{$data['result']->diet_plan_name}}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('diet_plan_name') has-danger @enderror">
                                                <label>Plan Name</label>
                                                <input class="form-control" placeholder="Enter a Name" type="text"
                                                    name="diet_plan_name" value="{{$data['result']->diet_plan_name}}" readonly>
                                                @error('diet_plan_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_breakfast') has-danger @enderror">
                                                <label>Breakfast</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Breakfast" name="diet_plan_breakfast" id="diet_plan_breakfast" rows="3" readonly>
                                                        {{$data['result']->breakfast}}
                                                    </textarea>
                                                @error('diet_plan_breakfast')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_dinner') has-danger @enderror">
                                                <label>Dinner</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Dinner" name="diet_plan_dinner" id="diet_plan_dinner" rows="3" readonly>
                                                    {{$data['result']->dinner}}
                                                    </textarea>
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
                                                <input class="form-control" placeholder="Enter a Name" type="text"
                                                name="diet_plan_name" value="{{$data['result']->bmi_category}}" readonly>
                                                @error('diet_plan_bmi_category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group @error('diet_plan_lunch') has-danger @enderror">
                                                <label>Lunch</label>
                                                    <textarea class="form-control" placeholder="Enter Meals for Lunch" name="diet_plan_lunch" id="diet_plan_lunch" rows="3" readonly>
                                                       {{$data['result']->lunch}}
                                                    </textarea>
                                                @error('diet_plan_lunch')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                         </div>

                                        <div class="col-md-8">
                                            <div class="form-group @error('diet_plan_day') has-danger @enderror">
                                                <label>Selected Days</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" ></span>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input type="checkbox" value="yes" name="diet_day_monday"   {{$data['result']->diet_monday == "yes" ? 'checked' : '' }} onclick="return false"><span>Monday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input type="checkbox" value="yes" name="diet_day_tuesday"   {{  $data['result']->diet_tuesday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Tuesday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_wednesday" {{  $data['result']->diet_wednesday == "yes"  ? 'checked' : ''  }} onclick="return false"><span>Wednesday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_thursday" {{  $data['result']->diet_thursday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Thursday</span></label>
                                                    </div>
                                                    <br>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_friday" {{ $data['result']->diet_friday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Friday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_saturday" {{ $data['result']->diet_saturday == "yes"  ? 'checked' : '' }} onclick="return false"><span>Saturday</span></label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input  type="checkbox" value="yes" name="diet_day_sunday" {{ $data['result']->diet_sunday == "yes" ? 'checked' : '' }} onclick="return false"><span>Sunday</span></label>
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
                                                    <textarea class="form-control" placeholder="Enter a Brief Description" name="diet_plan_description" id="diet_plan_description" rows="3" readonly>
                                                        {{$data['result']->diet_desc}}
                                                    </textarea>
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
                                                    {{-- <button  type="submit" id="submit" class="btn btn-success">Print</button> --}}
                                                    {{-- <button type="button" id="clear" class="btn btn-secondary text-white" >Clear</button> --}}
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
