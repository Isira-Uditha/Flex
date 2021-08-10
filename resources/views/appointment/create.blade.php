@extends('layouts.default')

@push('styles')

@endpush

@section('title','Booking')
@section('sub_title','Add Appointment')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-3">Add Appointment</h6>
                <form  method="POST" class="login-form">
                    @csrf
                    <input type='text' name="bmi" value="0" hidden id="hidden_bmi">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group @error('uid') has-danger @enderror">
                                <label>User ID</label>
                                <input class="form-control" type="text" name="uid" value="{{$data['userID']->uid}}" disabled>
                                @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('appointment_date') has-danger @enderror">
                                <label>Booking Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" value="{{date('d/m/Y')}}" name="appointment_date" type="text" id="appointment_date">
                                </div>
                                @error('appointment_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('current_height') has-danger @enderror">
                                <label>Current Height (m)</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                <input class="form-control" type="text" placeholder="please enter current height" name="current_height" id="current_height">
                                @error('current_height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('workout_plan_id') has-danger @enderror">
                                <label>Workout Plan</label>
                                <select class="form-control select2" name="workout_plan_id" id="workout_plan_id">
                                    <option value="" label="Choose one">
                                        Choose one
                                    </option>
                                    @foreach ($data['workouts'] as $res)
                                    <option value="{{$res->workout_plan_id}}">
                                        {{$res->workout_plan_name}}
                                    </option>
                                    @endforeach

                                </select>
                                @error('workout_plan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group @error('userName') has-danger @enderror">
                                <label>User Name</label>
                                <input class="form-control" type="text" name="userName" value="{{Str::title($data['userName']->userName)}}" disabled>
                                @error('userName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('time_slot') has-danger @enderror">
                                <label>Time Slot</label>
                                <select class="form-control select2" name="time_slot" id="time_slot">
                                    <option value="" label="Choose one">
                                        Choose one
                                    </option>
                                    <option value="7-9">
                                        7.00 am &nbsp; - &nbsp; 9.00 am
                                    </option>
                                    <option value="9-11">
                                        9.00 am &nbsp; - &nbsp; 11.00 am
                                    </option>
                                    <option value="13-15">
                                        1.00 pm &nbsp; - &nbsp; 3.00 pm
                                    </option>
                                    <option value="15-17">
                                        3.00 pm &nbsp; - &nbsp; 5.00 pm
                                    </option>
                                    <option value="17-19">
                                        5.00 pm &nbsp; - &nbsp; 7.00 pm
                                    </option>
                                    <option value="19-21">
                                        7.00 pm &nbsp; - &nbsp; 9.00 pm
                                    </option>
                                </select>
                                @error('time_slot')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('current_weight') has-danger @enderror">
                                <label>Current Weight (Kg)</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                <input class="form-control" type="text" placeholder="please enter current height" name="current_weight" id="current_weight">
                                @error('current_weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div class="row card-footer">
                        <div class="col-md-6 text-left">
                            <div class="form-group col-md-12">
                                <button type="submit" id="search" class="btn btn-primary">Cehck Availability</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('appointment_create',['action' => 'Add','id' => ''])}}" type="button" id="search" class="btn btn-success">Save</a>
                                <a type="button" id="search" class="btn btn-secondary text-white">Clear</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-3">Booking Details</h6>
                <div class="table-responsive" id="b_table">
                    <table class="table mg-b-0 text-md-nowrap table-borderless">
                        <tbody>
                            <tr>
                                <th class="text-right">Availability</th>
                                <td class="text-right">:</td>
                                {{-- <td class="text-left" id="b_availability"><span class="badge badge-success tx-13">Availble</span></td> --}}
                                <td class="text-left" id="b_availability">Not Checked</td>
                            </tr>
                            <tr>
                                <th class="text-right">Available Number</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="b_number">Not Checked</td>
                            </tr>
                            <tr>
                                <th class="text-right">Date</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="b_date">{{date('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Time Slot</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="b_time">Not Selected</td>
                            </tr>
                            <tr>
                                <th class="text-right">Schedule</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="b_schedule">Not Selected</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-3">BMI Calculator</h6>
                <div class="table-responsive" id="c_table">
                    <table class="table mg-b-0 text-md-nowrap table-borderless">
                        <tbody>
                            <tr>
                                <th class="text-right">Height (m)</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="c_height">0</td>
                            </tr>
                            <tr>
                                <th class="text-right">Weight (Kg)</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="c_weight">0</td>
                            </tr>
                            <tr>
                                <th class="text-right">BMI</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="c_bmi">0</td>
                            </tr>
                            <tr>
                                <th class="text-right">BMI Status</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="c_status">Not Checked</td>
                            </tr>
                            <tr>
                                <th class="text-right">Sugested Schedule</th>
                                <td class="text-right">:</td>
                                <td class="text-left" id="c_schedule">Not Checked</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection



@push('scripts')
<script>
$(document).ready(function () {

    //Calculate BMI
    $('#current_height, #current_weight').keyup(function (e) {

        var keyCode = e.keyCode || e.which;
        var value = $(this).val();
        if(keyupValidation(keyCode,value) == true){
            $(this).val('');
        };

        if( $('#current_height').val() != "" && $('#current_weight').val() != ""){
            bmiCalculator();
        }

    });

    $('#appointment_date,#time_slot,#workout_plan_id').change(function (e) {
        e.preventDefault();
        bookingDetails($(this).attr('id'));
    });
});

function bmiCalculator(){
    var height = $('#current_height').val();
    var weight = $('#current_weight').val();
    var bmi = weight/(height*height);
    $('#c_height').text(height);
    $('#c_weight').text(weight);
    $('#c_bmi').text(bmi.toFixed(2));
    $('#hidden_bmi').val(bmi.toFixed(2));
    if(bmi.toFixed(2) < 18.50){
        $('#c_schedule').html('<span class="badge badge-danger tx-13">Underweight</span>');
    }else if(bmi.toFixed(2) >= 18.50 && bmi.toFixed(2) < 24.90){
        $('#c_schedule').html('<span class="badge badge-success tx-13">Normal weight</span>');
    }else if(bmi.toFixed(2) >= 24.90 && bmi.toFixed(2) < 30.00){
        $('#c_schedule').html('<span class="badge badge-warning tx-13">Overweight</span>');
    }else{
        $('#c_schedule').html('<span class="badge badge-danger tx-13">Obese</span>');
    }
}

function keyupValidation(keyCode,value){
    var regex = /^[0-9]+$/;

    var isValid = regex.test(String.fromCharCode(keyCode));

    if(value.indexOf('.') != -1){
        var count = (value.match(/\./g) || []).length;
        if(count == 1){
            isValid = true;
        }
    }

    if (!isValid) {
        $('#c_height').text('0');
        $('#c_weight').text('0');
        $('#c_bmi').text('0');
        $('#hidden_bmi').val(0);
        $('#c_schedule').html('');
        return true;
    }else{
        return false
    }
}

function bookingDetails(id){
    if(id == 'time_slot'){
        $('#b_time').text($('#time_slot option:selected').text());
    }

    if(id == 'workout_plan_id'){
        $('#b_schedule').text($('#workout_plan_id option:selected').text());
    }

    if(id == 'appointment_date'){
        $('#b_date').text($('#appointment_date').val());
    }
}
</script>
@endpush
