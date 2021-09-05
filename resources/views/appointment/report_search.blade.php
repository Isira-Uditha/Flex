@extends('layouts.default')

@push('styles')

@endpush

@section('title','Booking')
@section('sub_title','Appointment')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Print Appointments</h6>
                    <form action="{{route('appointment_create',['action' => 'Print', 'id' => ''])}}"  method="POST" class="login-form" id="form_id">

                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group @error('from') has-danger @enderror">
                                    <label class="">Date : From</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input class="form-control fc-datepicker" onkeydown="false" name="from" value="{{$from}}" id="dateFrom" type="text">
                                    </div>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @error('to') has-danger @enderror">
                                    <label class="">Date : To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input class="form-control fc-datepicker" onkeydown="false" name="to" value="{{date('m/d/Y')}}" id="dateTo" type="text">
                                    </div>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                    <button type="submit" id="print" class="btn btn-success">Print</button>
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
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Appointment No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time Slot</th>
                            <th scope="col">Workout Plan</th>
                            <th scope="col">BMI</th>
                            <th scope="col">BMI Category</th>
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
                    data: 'appointment_id',
                    name: 'appointment_id'
                },
                {
                    data: 'appointment_no',
                    name: 'appointment_no'
                },
                {
                    data: 'appointment_date',
                    name: 'appointment_date'
                },
                {
                    data: 'time_slot',
                    name: 'time_slot'
                },
                {
                    data: 'workout_plan_name',
                    name: 'workout_plan_name'
                },
                {
                    data: 'bmi',
                    name: 'bmi'
                },
                {
                    data: 'bmi_type',
                    name: 'bmi_type'
                }
            ]
        });
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
         })
});

</script>
@endpush
