@extends('layouts.default')

@push('styles')

@endpush
@php
    $action = $data['action'];
    $u_type = $data['u_type'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
@endphp
@section('title',$u_type)
@section('sub_title', $action.' ' .$u_type)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1"></h6>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('user_create', ['u_type' => $u_type ,'action' => $action, 'id' => $id])}}" method="POST" class="login-form">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group @error('first_name') has-danger @enderror">
                                        <label>First Name</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <input class="form-control" placeholder="Enter First Name" type="text" id="first_name"
                                            name="first_name" @if(!empty(old('first_name'))) value="{{old('first_name')}}" @elseif(isset($data['result'])) value="{{$data['result']->first_name}}" @else value="" @endif>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('last_name') has-danger @enderror">
                                        <label>Last Name</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <input class="form-control" placeholder="Enter Last Name" type="text" id="last_name"
                                            name="last_name" @if(!empty(old('last_name'))) value="{{old('last_name')}}" @elseif(isset($data['result'])) value="{{$data['result']->last_name}}" @else value="" @endif>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('address') has-danger @enderror">
                                        <label>Address</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <textarea class="form-control text-left" name="address" id="address" placeholder="Enter Address" rows="3">
                                                @if(!empty(old('address'))) {{old('address')}} @elseif(isset($data['result'])) {{$data['result']->address}} @else @endif
                                            </textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('gender') has-danger @enderror">
                                        <label>Gender</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <div class="col-lg-3">
											<label class="rdiobox"><input name="gender" type="radio" value="Male"
                                                @if(!empty(old('gender')) && (old('gender') == 'Male')) checked @elseif(isset($data['result']) && $data['result']->gender == 'Male') checked @else value="" @endif>
                                                <span>Male</span>
                                            </label>
											<label class="rdiobox"><input name="gender" type="radio" value="Female"
                                                @if(!empty(old('gender')) && (old('gender') == 'Female')) checked @elseif(isset($data['result']) && $data['result']->gender == 'Female') checked @else value="" @endif>
                                                <span>Female</span>
                                            </label>
										</div>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('dob') has-danger @enderror">
                                        <label>Date of Birth</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker" @if(!empty(old('dob'))) value="{{old('dob')}}" @elseif(isset($data['result'])) value="{{date("m/d/Y", strtotime($data['result']->bod))}}" @else value="{{date('m/d/Y')}}" @endif  name="dob" type="text" id="dob">
                                        </div>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('email') has-danger @enderror">
                                        <label>Email</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <input class="form-control" placeholder="Enter Email" type="text" id="email"
                                            name="email" @if(!empty(old('email'))) value="{{old('email')}}" @elseif(isset($data['result'])) value="{{$data['result']->email}}" @else value="" @endif>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('height') has-danger @enderror">
                                        <label>Height</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <input class="form-control" placeholder="Enter Height in cm" type="text" id="height"
                                            name="height" @if(!empty(old('height'))) value="{{old('height')}}" @elseif(isset($data['result'])) value="{{$data['result']->height}}" @else value="" @endif>
                                        @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('weight') has-danger @enderror">
                                        <label>Weight</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                        <input class="form-control" placeholder="Enter Weight in kg" type="text" id="weight"
                                            name="weight" @if(!empty(old('weight'))) value="{{old('weight')}}" @elseif(isset($data['result'])) value="{{$data['result']->weight}}" @else value="" @endif>
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                @if ($u_type === 'Member')
                                    <div class="col-md-6">
                                        <div class="form-group @error('role') has-danger @enderror">
                                            <label>Role</label>
                                            <input class="form-control" name="role" id="role" type="text" value="Member" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('package_id') has-danger @enderror">
                                            <label>Package</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <select class="form-control select2" name="package_id">
                                                <option label="Choose one" value="">
                                                    Choose one
                                                </option>
                                                @foreach ($data['packages'] as $package)
                                                    <option value="{{$package->package_id}}" @if(!empty(old('package_id')) && old('package_id') ==  $package->package_id) selected @elseif(isset($data['result']) && $data['result']->package_id ==  $package->package_id) selected @endif>
                                                        {{$package->package_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if($action == 'Edit')
                                        <div class="col-md-6">
                                            <div class="form-group @error('password') has-danger @enderror">
                                                <label>Password</label>
                                                <input class="form-control" placeholder="Enter Password" type="text" id="password"
                                                    name="password" @if(!empty(old('password'))) value="{{old('password')}}" @elseif(isset($data['result'])) value="{{$data['result']->password}}" @else value="" @endif>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @php
                                        $roles = [
                                            'Personal Fitness Trainer' => 'Personal Fitness Trainer',
                                            'Accountant' => 'Accountant',
                                            'Manager' => 'Manager',
                                            'Cleanning Staff' => 'Cleanning Staff',
                                        ]
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group @error('role') has-danger @enderror">
                                            <label>Employee Role</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <select class="form-control select2" name="role">
                                                <option label="Choose one" value="">
                                                    Choose one
                                                </option>
                                                @foreach ($roles as $key => $value )
                                                    <option value="{{$value}}" @if(!empty(old('role') && old('role') == $value)) selected @elseif(isset($data['result']) && $data['result']->role == $value) selected @endif>
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
                                @endif

                                <div class="col-md-12 text-right">
                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0" data-placement="top"
                                        data-toggle="tooltip-primary" title="Save Details">{{(isset($data['result'])) ? 'Update' : 'Register'}}</button>
                                        <button type="button" id="clear" class="btn btn-secondary text-white mt-3 mb-0" data-placement="top"
                                        data-toggle="tooltip-secondary" title="Reset the form">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').css('width','100%');
    });

    $('#clear').click(function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will clear all the details you inserted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                $('#first_name, #last_name, #address, #email, #height, #weight, #dob').val("");
                $('.select2').val('');
                $('.select2').trigger('change');
                $('.select2').css('width','100%');
            }
        });
    });
</script>
@endpush