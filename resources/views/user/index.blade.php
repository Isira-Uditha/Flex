@extends('layouts.default')

@push('styles')

@endpush

@section('title','Members')
@section('sub_title', 'Currrent Members')

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
                <h6 class="card-title mb-1">Search Members</h6>
                <form  method="POST" class="login-form" id="form_id">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <div class="form-group @error('package_name') has-danger @enderror">
                                <label>Search by Package Name</label>
                                <input class="form-control" placeholder="Enter Package name" type="text"
                                    name="package_name">
                                @error('package_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('package_duration') has-danger @enderror">
                                <label>Search by Duration</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('package_price') has-danger @enderror">
                                <label>Search by Price</label>
                                <input class="form-control" placeholder="Enter Price" type="text"
                                    name="package_price">
                                @error('package_price')
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
                                <button type="button" id="submit" class="btn btn-primary mt-3 mb-0">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('user_view',['action' => 'Add', 'id' => ''])}}" type="button" class="btn btn-success">Add Member</a>
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
                            <th scope="col">Package ID</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Package Description</th>
                            <th scope="col">Package Duration</th>
                            <th scope="col">Package Price</th>
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
        $('#submit').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })
});

</script>
@endpush

