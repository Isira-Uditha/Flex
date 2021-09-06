@extends('layouts.default')

@push('styles')

@endpush

@section('title','Package')
@section('sub_title', 'Active Packages')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1">Package Summary</h6>
                <form  method="POST" class="login-form" id="form_id">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <div class="form-group @error('from') has-danger @enderror">
                                <label>From</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="from" type="text" id="from">
                                </div>
                                @error('from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @error('to') has-danger @enderror">
                                <label>To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="to" type="text" id="to">
                                </div>
                                @error('to')
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
                                <a href="#" type="button" class="btn btn-success mt-3 mb-0">Print Report</a>
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
                            <th scope="col">Package Duration</th>
                            <th scope="col">Members Enrolled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['result'] as $row)
                        <tr>
                            <td>{{$row->package_id}}</td>
                            <td>{{$row->package_name}}</td>
                            <td>{{$row->package_duration}}</td>
                            <td>{{$row->count}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
