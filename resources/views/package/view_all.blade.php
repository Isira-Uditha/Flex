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
                        {{-- <div class="col-12 col-sm-6 col-lg-6 col-xl-4">
                            <div class="card card-primary">
                                <div class="card-header pb-0">
                                    @if ($package->discount > 0)
                                        <h6 class="text-danger">* Discount : {{$package->discount}}</h6>
                                    @endif
                                    <h5 class="card-title mb-0 pb-0">{{$package->package_name}}</h5>
                                </div>
                                <div class="card-body text-primary text-justify">
                                    {{$package->package_description}}
                                </div>
                                <div class="card-footer">
                                    Package Price : {{$package->package_price}}
                                </div>
                                @if ($package->discount > 0)
                                    <div class="card-footer">
                                        <h6 class="text-danger">* Discounted Price : {{$package->package_price - $package->discount}} </h6>
                                    </div>
                                @endif
                            </div>
                        </div> --}}

                        @php
                            $img = Storage::disk('accountsdocs')->get($package->image_path);
                            $type =  pathinfo(Storage::disk('accountsdocs')->path($package->image_path), PATHINFO_EXTENSION);
                            $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
                            $imageName = explode("/",$package->image_path);
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-md-12">
                            <div class="card">
                                {{-- <img class="card-img-top w-100" src="" alt=""> --}}
                                <div id="fImage">
                                    <img src="{{$path}}"  class="bd mb-2" name="fImage" >
                                    {{-- <h6 class="text-primary">{{Str::ucfirst($imageName[1])}}</h6> --}}
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title mb-3">{{$package->package_name}}</h4>
                                    <p class="card-text text-justify">{{$package->package_description}}</p>
                                    <h6 class="card-footer">Package Price : {{$package->package_price}}</h6>
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
