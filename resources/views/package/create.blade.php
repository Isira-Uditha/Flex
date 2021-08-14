@extends('layouts.default')

@push('styles')

@endpush
@php
    $action = $data['action'];
@endphp
@section('title','Package')
@section('sub_title', $action.' Package')

@section('content')
@php
    $duration = [
        '1 Month' => '1 Month',
        '3 Months' => '3 Months',
        '6 Months'=> '6 Months',
        '1 Year' => '1 Year',
        '2 Years' => '2 Years',
        '5 Years' => '5 Years',
    ]
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1"></h6>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('package_create')}}" method="POST" class="login-form">
                                @csrf
                                <div class="form-group @error('package_name') has-danger @enderror">
                                    <label>Package Name</label>
                                    <input class="form-control" placeholder="Enter Package Name" type="text"
                                        name="package_name" @if(!empty(old('package_name'))) value="{{old('package_name')}}" @else value="" @endif>
                                    @error('package_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('package_description') has-danger @enderror">
                                    <label>Package Description</label>
                                        <textarea class="form-control" name="package_description" placeholder="Enter Packge Description" rows="3"
                                            @if(!empty(old('package_description'))) value="{{old('package_description')}}" @else value="" @endif>
                                        </textarea>
                                    @error('package_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('package_duration') has-danger @enderror">
                                    <label>Duration</label>
                                    <select class="form-control select2" name="package_duration">
                                        <option label="Choose one" value="">
                                            Choose one
                                        </option>
                                        @foreach ($duration as $key => $value )
                                            <option value="{{$value}}" @if(!empty(old('package_duration') && old('package_duration') == $value)) selected @endif>
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
                                <div class="form-group @error('package_price') has-danger @enderror">
                                    <label>Package Price</label>
                                    <input class="form-control" placeholder="Enter Package Price" type="number" name="package_price"
                                        @if(!empty(old('package_price'))) value="{{old('package_price')}}" @else value="" @endif>
                                    @error('package_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 text-right">
                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0" data-placement="top"
                                        data-toggle="tooltip-primary" title="Submit the package">Submit</button>
                                        <button type="button" id="clear" class="btn btn-secondary text-white mt-3 mb-0">Clear</button>
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




