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
                    <h6 class="card-title mb-1">Search Bookings</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        @csrf
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group @error('appointment_id') has-danger @enderror">
                                <label>Appointment ID</label>
                                <input class="form-control" placeholder="Search by appointment ID" type="text" name="appointment_id">
                                @error('appointment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
                            <div class="form-group @error('time_slot') has-danger @enderror">
                                <label>Time Slot</label>
                                <select class="form-control select2" name="time_slot">
                                    <option value=" " label="Choose one">
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
                            <div class="form-group @error('workout_plan_id') has-danger @enderror">
                                <label>Workouts</label>
                                <select class="form-control select2" name="workout_plan_id">
                                    <option label="Choose one" value=" ">
                                        Choose one
                                    </option>
                                    @foreach ($data['workouts'] as $result)
                                    <option value="{{$result->workout_plan_id}}">
                                        {{$result->workout_plan_name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('workout_plan_id')
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
                                <a href="{{route('appointment_view',['action' => 'Add','id' => ''])}}" type="button" id="search" class="btn btn-success">Add Appointment</a>
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
                            <th scope="col">Current Height</th>
                            <th scope="col">Current Weight</th>
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
                },
                {
                    data: 'current_height',
                    name: 'current_height'
                },
                {
                    data: 'current_weight',
                    name: 'current_weight'
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

        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var appid = $(this).closest("a").data('appid');
            var res = deleteAppointment(appid);
        });

        function deleteAppointment(appid){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('appointment_create',['action' => 'Delete','id' =>"appid"])}}",
                        data: {'id':appid,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success){
                                $('*[data-appid="' + appid + '"]').closest("tr").remove();
                                Swal.fire(
                                'Deleted!',
                                'Record has been deleted successfully.',
                                'success'
                                );
                            }
                        }
                    });
                }
            });

        }
});

</script>
@endpush
