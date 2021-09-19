@extends('layouts.default')

@push('styles')

@endpush

@section('title','Package')
@section('sub_title', 'View Available Packages')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    @foreach($data['packages'] as $package)
                        @php
                            $img = Storage::disk('accountsdocs')->get($package->image_path);
                            $type =  pathinfo(Storage::disk('accountsdocs')->path($package->image_path), PATHINFO_EXTENSION);
                            $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
                            $imageName = explode("/",$package->image_path);
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-md-12">
                            <div class="card">
                                <div id="fImage">
                                    <img src="{{$path}}"  class="bd mb-2" name="fImage">
                                    @if ($package->discount > 0)
                                    <div class="tags">
                                        <span class="tag tag-red">* Discount : LKR.{{$package->discount}}.00</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title mb-3">{{$package->package_name}}</h4>
                                    <p class="card-text text-justify">{{$package->package_description}}</p>
                                    <h6 class="card-text text-justify">Duration : {{$package->package_duration}}</h6>
                                    <h6 class="card-footer text-center">Package Price : LKR.{{$package->package_price}}.00</h6>
                                    @if ($package->discount > 0)
                                        <h6 class="card-footer text-center">Discounted Price : LKR.{{$package->package_price - $package->discount}}.00</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
