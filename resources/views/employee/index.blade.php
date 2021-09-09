@extends('layouts.default')

@push('styles')

@endpush

@section('title','Employees')
@section('sub_title', 'Currrent Employees')

@section('content')
@php
    $gender = [
        'Male' => 'Male',
        'Female' => 'Female'
    ];

    $roles = [
        'Personal Fitness Trainer' => 'Personal Fitness Trainer',
        'Accountant' => 'Accountant',
        'Manager' => 'Manager',
        'Cleanning Staff' => 'Cleanning Staff',
    ]

@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1">Search Employees</h6>
                <form  method="POST" class="login-form" id="form_id">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <div class="form-group @error('first_name') has-danger @enderror">
                                <label>Search by First Name</label>
                                <input class="form-control" placeholder="Enter First Name" type="text"
                                    name="first_name">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <div class="form-group @error('last_name') has-danger @enderror">
                                <label>Search by Last Name</label>
                                <input class="form-control" placeholder="Enter Last Name" type="text"
                                    name="last_name">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('gender') has-danger @enderror">
                                <label>Search by Gender</label>
                                <select class="form-control select2" name="gender">
                                    <option label="Choose one" value="">
                                        Choose one
                                    </option>
                                    @foreach ($gender as $key => $value )
                                        <option value="{{$value}}" @if(!empty(old('gender') && old('gender') == $value)) selected @endif>
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('uid') has-danger @enderror">
                                <label>Search by ID</label>
                                <input class="form-control" placeholder="Enter User ID" type="text"
                                    name="uid">
                                @error('uid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('role') has-danger @enderror">
                                <label>Search by Role</label>
                                <select class="form-control select2" name="role">
                                    <option label="Choose one" value="">
                                        Choose one
                                    </option>
                                    @foreach ($roles as $key => $value )
                                        <option value="{{$value}}" @if(!empty(old('role') && old('role') == $value)) selected @endif>
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
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
                                <button type="button" id="submit" class="btn btn-primary mt-0 mb-0">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('user_view',['u_type' => 'Employee', 'action' => 'Add', 'id' => ''])}}" type="button" class="btn btn-success">Add Employee</a>
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
                            <th scope="col">User ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Height</th>
                            <th scope="col">Address</th>
                            <th scope="col">Role</th>
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
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            order: false,
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
                    data: 'uid',
                    name: 'uid'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'gender',
                    name: 'gender'
                },
                {
                    data: 'dob',
                    name: 'dob'
                },
                {
                    data: 'weight',
                    name: 'weight'
                },
                {
                    data: 'height',
                    name: 'height'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#submit').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
        })

        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var appid = $(this).closest("a").data('appid');
            var res = deleteUser(appid);
        });

        function deleteUser(appid){
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
                        url: "{{route('user_create',['u_type' => 'Employee', 'action' => 'Delete','id' =>"appid"])}}",
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
