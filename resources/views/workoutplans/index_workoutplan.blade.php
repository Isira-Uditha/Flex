@extends('layouts.default')

@push('styles')

@endpush

@section('title','WorkOut Plan')
@section('sub_title','')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Search Workout Plans</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        @csrf
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group @error('workout_plan_id') has-danger @enderror">
                                <label>Workout Plan ID</label>
                                <input class="form-control" placeholder="Search by Workout Plan ID" type="text" name="workout_plan_id">
                                @error('workout_plan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group @error('workout_plan_duration') has-danger @enderror">
                                <label class="">Duration</label>
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
                        <div class="col-md-4">
                            <div class="form-group @error('workout_plan_name') has-danger @enderror">
                                <label>Workout Plan Name</label>
                                <input class="form-control" placeholder="Search by Workout Plan Name" type="text" name="workout_plan_name">
                                @error('workout_plan_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group @error('created_date') has-danger @enderror">
                                <label class="">Created Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" onkeydown="false" name="created_date" value="{{date('m/d/Y')}}" id="created_date" type="text">
                                </div>
                                @error('created_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                <div>
                                    <label>&nbsp;</label>
                                </div>
                                <div class="form-group">
                                    <label class="ckbox">
                                        <input type="checkbox" name="sts_date" id="sts_date" checked
                                            {{ old('sts_date') ? 'checked' : '' }}>
                                        <span>{{ __('Ignore Date') }}</span>
                                    </label>
                                </div>
                            </div>
                    </div><br/>
                    <div class="row card-footer">
                        <div class="col-md-6 text-left">
                            <div class="form-group col-md-12">
                                <button type="submit" id="search" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('create_workoutPlan_view')}}" type="button" id="add" class="btn btn-success">Add Workout Plan</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">Workout Plan ID</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Workout Plan Name</th>
                            <th scope="col">BMI Category</th>
                            <th scope="col">Duration (Months)</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
$(document).ready(function () {
    $('.select2').css('width','100%');
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            filter: false,
            order:false,
            responsive: true,
            ajax: {
                url: "{{url()->current()}}",
                "type": "GET",
                "data": function (d) {
                    var frm = $('#form_id').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'workout_id',
                    name: 'workout_id'
                },
                {
                    data: 'created_date',
                    name: 'created_date'
                },
                {
                    data: 'workout_plan_name',
                    name: 'workout_plan_name'
                },
                {
                    data: 'bmi_category',
                    name: 'bmi_category'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

});

</script>
@endpush
