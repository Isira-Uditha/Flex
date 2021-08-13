@extends('layouts.default')

@push('styles')

@endpush
@php
    $action = $data['action'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
@endphp
@section('title','Booking')
@section('sub_title',$action . ' Appointment')

@section('content')
<div class="row">
    <div class="col-md-8 pb-3">
        <div class="card custom-card h-100">
            <form action="{{route('appointment_create',['action' => $action,'id' => $id])}}" id="form_id" method="POST" class="login-form">
                @csrf
            <div class="card-body">
                <h6 class="card-title mb-3">{{$action}} Appointment {{isset($data['id']) ? '- '.$data['id'] : ''}}</h6>
                <input type='text' name="bmi" value="0" hidden id="hidden_bmi">
                <input type='text' name="action" value="{{$action}}" hidden id="hidden_action">
                <input type='text' name="appointment_no" @if(!empty(old('appointment_no'))) value="{{old('appointment_no')}}" @elseif(isset($data['result'])) value="{{$data['result']->appointment_no}}" @else value=" " @endif hidden id="hidden_appointment_no">
                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group @error('uid') has-danger @enderror">
                            <label>User ID</label>
                            <input class="form-control" type="text" name="uid" value="{{$data['userID']->uid}}" readonly>
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
                                <input class="form-control fc-datepicker" @if(!empty(old('appointment_date'))) value="{{old('appointment_date')}}" @elseif(isset($data['result'])) value="{{date("m/d/Y", strtotime($data['result']->appointment_date))}}" @else value="{{date('m/d/Y')}}" @endif  name="appointment_date" type="text" id="appointment_date">
                            </div>
                            @error('appointment_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('current_height') has-danger @enderror">
                            <label>Current Height (m)</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                            <input class="form-control" type="text" placeholder="please enter current height" @if(!empty(old('current_height'))) value="{{old('current_height')}}" @elseif(isset($data['result'])) value="{{$data['result']->current_height}}" @endif name="current_height" id="current_height">
                            @error('current_height')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('workout_plan_id') has-danger @enderror"  id="workout_div">
                            <label>Workout Plan</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                            <select class="form-control select2" name="workout_plan_id" id="workout_plan_id">
                                <option value="" label="Choose one">
                                    Choose one
                                </option>
                                @foreach ($data['workouts'] as $res)
                                <option value="{{$res->workout_plan_id}}" @if(!empty(old('workout_plan_id')) && old('workout_plan_id') ==  $res->workout_plan_id) selected @elseif(isset($data['result']) && $data['result']->workout_plan_id ==  $res->workout_plan_id) selected @endif>
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
                            <input class="form-control" type="text" name="userName" value="{{Str::title($data['userName']->userName)}}" readonly>
                            @error('userName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('time_slot') has-danger @enderror">
                            <label>Time Slot</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                            <select class="form-control select2" name="time_slot" id="time_slot">
                                <option value="" label="Choose one">
                                    Choose one
                                </option>
                                <option value="7-9" @if(!empty(old('time_slot')) && old('time_slot') ==  "7-9") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "7-9") selected @endif>
                                    7.00 am &nbsp; - &nbsp; 9.00 am
                                </option>
                                <option value="9-11" @if(!empty(old('time_slot')) && old('time_slot') ==  "9-11") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "9-11") selected @endif>
                                    9.00 am &nbsp; - &nbsp; 11.00 am
                                </option>
                                <option value="13-15" @if(!empty(old('time_slot')) && old('time_slot') ==  "13-15") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "13-15") selected @endif>
                                    1.00 pm &nbsp; - &nbsp; 3.00 pm
                                </option>
                                <option value="15-17" @if(!empty(old('time_slot')) && old('time_slot') ==  "15-17") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "15-17") selected @endif>
                                    3.00 pm &nbsp; - &nbsp; 5.00 pm
                                </option>
                                <option value="17-19" @if(!empty(old('time_slot')) && old('time_slot') ==  "17-19") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "17-19") selected @endif>
                                    5.00 pm &nbsp; - &nbsp; 7.00 pm
                                </option>
                                <option value="19-21" @if(!empty(old('time_slot')) && old('time_slot') ==  "19-21") selected @elseif(isset($data['result']) && $data['result']->time_slot ==  "19-21") selected @endif>
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
                            <input class="form-control" type="text" placeholder="please enter current weight" @if(!empty(old('current_weight'))) value="{{old('current_weight')}}" @elseif(isset($data['result'])) value="{{$data['result']->current_weight}}" @endif name="current_weight" id="current_weight">
                            @error('current_weight')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                    </div>
                </div>
            </div>

            <div class="card-footer w-100" style="position: absolute; bottom: 0;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="form-group col-md-12">
                            <button type="button" id="search" class="btn btn-primary">Cehck Availability</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="form-group col-md-12">
                            <button  type="submit" id="save" class="btn btn-success">{{(isset($data['result'])) ? 'Update' : 'Save'}}</button>
                            <button type="button" id="clear" class="btn btn-secondary text-white">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                                <td class="text-left" id="b_number">{{(isset($data['result'])) ? $data['result']->appointment_no : 'Not Checked'}}</td>
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
    $('#workout_div').hide();
    $('#save').attr('disabled', 'disabled');
    //Calculate BMI
    $('#current_height, #current_weight').keyup(function (e) {

        var keyCode = e.keyCode || e.which;
        var value = $(this).val();
        if(keyupValidation(keyCode,value) == true){
            $(this).val('');
        };

        if( $('#current_height').val() != "" && $('#current_weight').val() != ""){
            bmiCalculator();
            $('#workout_div').show('slow');
            $('.select2').css('width','100%');
        }else{
            $('#workout_div').hide('slow');
            $('.select2').css('width','100%');

        }

    });

    $('#search').click(function (e) {
        e.preventDefault();
        if($('#appointment_date').val() != "" && $('#time_slot').val() != ""){
            checkAppointmentStatus();
            $('.select2').css('width','100%');
        }
    });

    $('#appointment_date,#time_slot,#workout_plan_id').change(function (e) {
        e.preventDefault();
        bookingDetails($(this).attr('id'));
        $('.select2').css('width','100%');

    });

    $('#clear').click(function (e) {
        e.preventDefault();
        $('#current_height, #current_weight, #appointment_date').val("");
        $('.select2').val('');
        $('.select2').trigger('change');
        $('#b_availability, #b_number, #c_status, #c_schedule').text('Not Checked');
        $('#b_time, #b_schedule, #b_date').text('Not Selected');
        $('#c_height, #c_weight, #c_bmi').text('0');
        $('.select2').css('width','100%');
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
        $('#c_status').html('<span class="tag tag-red">Underweight</span>');
    }else if(bmi.toFixed(2) >= 18.50 && bmi.toFixed(2) < 24.90){
        $('#c_status').html('<span class="tag tag-green">Normal weight</span>');
    }else if(bmi.toFixed(2) >= 24.90 && bmi.toFixed(2) < 30.00){
        $('#c_status').html('<span class="tag tag-yellow">Overweight</span>');
    }else{
        $('#c_status').html('<span class="tag tag-red">Obesity</span>');
    }
    getSugestedSchedules(bmi.toFixed(2));
    $('.select2').css('width','100%');

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
        $('#save').attr('disabled', 'disabled');
        $('#b_availability,#b_number').text('Not Checked');
        $('#b_time').text($('#time_slot option:selected').text());
    }

    if(id == 'workout_plan_id'){
        $('#b_schedule').text($('#workout_plan_id option:selected').text());
    }

    if(id == 'appointment_date'){
        $('#save').attr('disabled', 'disabled');
        $('#b_availability,#b_number').text('Not Checked');
        $('#b_date').text($('#appointment_date').val());
    }
}

function getSugestedSchedules(bmi){
    $.ajax({
        type: "GET",
        url: "{{route('getSugestedSchedules')}}",
        data: {'bmi': bmi},
        success: function (response) {
            $("#c_schedule").empty();
           $.each(response.data, function (index, value) {
                $("#c_schedule").append('<span class="text-primary">'+value.workout_plan_name + '</span><br>');
            });
        }
    });
}

function checkAppointmentStatus(){
    $.ajax({
            type: "GET",
            url: "{{route('checkAppointmentStatus')}}",
            data: $('#form_id').serializeArray(),
            success: function (response) {
                if(response.availablity == true){
                    $('#b_availability').html('<span class="tag tag-lime">Available</span>');
                    $('#b_number').text(response.number);
                    $('#hidden_appointment_no').val(response.number);
                    $('#save').removeAttr('disabled',false);
                }else{
                    $('#b_availability').html('<span class="tag tag-red">Unavailable</span>');
                    $('#b_number').text('No Available Slots');
                    $('#save').attr('disabled','disabled');
                }
            }
        });
}

function checkUpdateAppointmentStatus(){
    $.ajax({
            type: "GET",
            url: "{{route('checkAppointmentStatus')}}",
            data: $('#form_id').serializeArray(),
            success: function (response) {
                if(response.availablity == true){
                    $('#b_availability').html('<span class="tag tag-lime">Available</span>');
                    $('#hidden_appointment_no').val(response.number);
                    $('#save').removeAttr('disabled',false);
                }else{
                    $('#b_availability').html('<span class="tag tag-red">Unavailable</span>');
                    $('#b_number').text('No Available Slots');
                    $('#save').attr('disabled','disabled');
                }
            }
        });
}


</script>

@if(!empty(old('bmi')) || !empty(old('uid')) || !empty(old('appointment_date')) || !empty(old('time_slot')) || !empty(old('current_height')) || !empty(old('workout_plan_id')) || !empty(old('userName')) || !empty(old('current_weight')))
    <script>
        $(document).ready(function () {
            $('#workout_div').show();

            if( $('#current_height').val() != "" && $('#current_weight').val() != ""){
            bmiCalculator();
            }

            if($('#appointment_date').val() != "" && $('#time_slot').val() != ""){
                checkAppointmentStatus();
            }
            checkAppointmentStatus();
            $('.select2').css('width','100%');
            $('#b_date').text($('#appointment_date').val());
            $('#b_schedule').text($('#workout_plan_id option:selected').text());
            $('#b_time').text($('#time_slot option:selected').text());
        });

    </script>
@endif

@if($action == 'Edit')
<script>
    $(document).ready(function () {
        $('#workout_div').show();
        bmiCalculator();
        checkUpdateAppointmentStatus();
        $('#b_schedule').text($('#workout_plan_id option:selected').text());
        $('#b_time').text($('#time_slot option:selected').text());
    });
</script>
@endif
@endpush
