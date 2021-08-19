@extends('layouts.default')

@push('styles')

@endpush
@php
    $action = $data['action'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
@endphp
@section('title','Employee')
@section('sub_title', $action.' Employee')

@section('content')
@php
    $roles = [
        '1 Month' => '1 Month',
        '3 Months' => '3 Months',
        '6 Months'=> '6 Months',
        '1 Year' => '1 Year',
        '2 Years' => '2 Years',
        '5 Years' => '5 Years',
    ]
@endphp
<div class="row">
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1"></h6>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('user_create', ['action' => $action, 'id' => $id])}}" method="POST" class="login-form">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group @error('first_name') has-danger @enderror">
                                        <label>First Name</label>
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
                                        <label>Last Name</label>
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
                                    <div class="form-group @error('dob') has-danger @enderror">
                                        <label>Date of Birth</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker" @if(!empty(old('dob'))) value="{{old('dob')}}" @elseif(isset($data['result'])) value="{{date("m/d/Y", strtotime($data['result']->dob))}}" @else value="{{date('m/d/Y')}}" @endif  name="dob" type="text" id="dob">
                                        </div>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('address') has-danger @enderror">
                                        <label>Address</label>
                                            <textarea class="form-control text-left" name="address" id="package_description" placeholder="Enter Address" rows="3">
                                                @if(!empty(old('address'))) {{old('address')}} @elseif(isset($data['result'])) {{$data['result']->address}} @else  @endif
                                            </textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('email') has-danger @enderror">
                                        <label>Email</label>
                                        <input class="form-control" placeholder="Enter Email" type="text" id="email"
                                            name="email" @if(!empty(old('email'))) value="{{old('email')}}" @elseif(isset($data['result'])) value="{{$data['result']->email}}" @else value="" @endif>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('role') has-danger @enderror">
                                    <label>Role</label>
                                    <select class="form-control select2" name="package_duration">
                                        <option label="Choose one" value="">
                                            Choose one
                                        </option>
                                        @foreach ($roles as $key => $value )
                                            <option value="{{$value}}" @if(!empty(old('package_duration') && old('package_duration') == $value)) selected @elseif(isset($data['result']) && $data['result']->package_duration == $value) selected @endif>
                                                {{$value}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('package_duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('height') has-danger @enderror">
                                        <label>Height</label>
                                        <input class="form-control" placeholder="Enter Height" type="text" id="height"
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
                                        <label>Weight</label>
                                        <input class="form-control" placeholder="Enter Weight" type="text" id="weight"
                                            name="weight" @if(!empty(old('weight'))) value="{{old('weight')}}" @elseif(isset($data['result'])) value="{{$data['result']->weight}}" @else value="" @endif>
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('package_id') has-danger @enderror">
                                        <label>Package</label>
                                        <select class="form-control select2" name="package_id">
                                            <option label="Choose one" value="">
                                                Choose one
                                            </option>
                                            @foreach ($data['packages'] as $package)
                                                <option value="{{$package->package_id}}" @if(!empty(old('workout_plan_id')) && old('workout_plan_id') ==  $package->package_id) selected @elseif(isset($data['result']) && $package['result']->package_id ==  $package->package_id) selected @endif>
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
     $('#clear').click(function (e) {
        e.preventDefault();
        $('#first_name, #last_name, #address, #email, #height, #weight').val("");
        $('.select2').val('');
        $('.select2').trigger('change');
        $('.select2').css('width','100%');
    });
</script>
@endpush
