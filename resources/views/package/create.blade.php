@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
<link href="{{asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@php
    $action = $data['action'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
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
                            <form action="{{route('package_create', ['action' => $action, 'id' => $id])}}" method="POST" class="login-form" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group @error('package_name') has-danger @enderror">
                                            <label>Package Name</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Package Name" type="text" id="package_name"
                                                name="package_name" @if(!empty(old('package_name'))) value="{{old('package_name')}}" @elseif(isset($data['result'])) value="{{$data['result']->package_name}}" @else value="" @endif>
                                            @error('package_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('package_duration') has-danger @enderror">
                                            <label>Duration</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <select class="form-control select2" name="package_duration">
                                                <option label="Choose one" value="">
                                                    Choose one
                                                </option>
                                                @foreach ($duration as $key => $value )
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('package_description') has-danger @enderror">
                                            <label>Package Description</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                                <textarea class="form-control text-left" name="package_description" id="package_description" placeholder="Enter Packge Description" rows="3">@if(!empty(old('package_description'))) {{old('package_description')}} @elseif(isset($data['result'])) {{$data['result']->package_description}} @else  @endif</textarea>
                                            @error('package_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('package_price') has-danger @enderror">
                                            <label>Package Price</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Package Price" id="package_price" type="text" name="package_price"
                                                @if(!empty(old('package_price'))) value="{{old('package_price')}}" @elseif(isset($data['result'])) value="{{$data['result']->package_price}}" @else value="" @endif>
                                            @error('package_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ($action == 'Add')
                                        <div class="col-md-12">
                                            <div class="form-group @error('image') has-danger @enderror">
                                                <label for="image">Package Display Image<span class="tx-danger">*</span></label>
                                                <div class="">
                                                    <input type="file" name="image" data-allowed-file-extensions="jpg png" id="image" class="dropify form-control" data-height="200" />
                                                </div>
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @elseif ($action == 'Edit')
                                    <div class="col-md-6">
                                        <div class="form-group @error('image') has-danger @enderror">
                                            <label for="image" class="mb-3">Package Display Image</label><br/>
                                            @php
                                                    $img = Storage::disk('accountsdocs')->get($data['result']->image_path);
                                                    $type =  pathinfo(Storage::disk('accountsdocs')->path($data['result']->image_path), PATHINFO_EXTENSION);
                                                    $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
                                                    $imageName = explode("/",$data['result']->image_path)
                                                    @endphp
                                                <div id="fImage">
                                                    <img src="{{$path}}"  class="bd mb-2" name="fImage" height="100px">
                                                    <h6 class="text-primary">{{Str::ucfirst($imageName[1])}}</h6>
                                                </div>
                                                <div class="">
                                                    <input type="file" name="image" id="image" data-allowed-file-extensions="jpg png" value="{{$data['result']->image_path}}"  class="dropify form-control" data-height="200" />
                                                </div>
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('discount') has-danger @enderror">
                                                <label>Discount Price</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                                <input class="form-control" placeholder="Enter Discount Price" id="discount" type="text" name="discount"
                                                    @if(!empty(old('discount'))) value="{{old('discount')}}" @elseif(isset($data['result'])) value="{{$data['result']->discount}}" @else value="" @endif>
                                                @error('discount')
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
                                            data-toggle="tooltip-primary" title="Submit the package">{{(isset($data['result'])) ? 'Update' : 'Save'}}</button>
                                            <button type="button" id="clear" class="btn btn-secondary text-white mt-3 mb-0">Clear</button>
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
        e.preventDefault();
        $('#package_name, #package_description, #package_price').val("");
        $('.select2').val('');
        $('.select2').trigger('change');
        $('.select2').css('width','100%');
        $(".dropify-clear").trigger('click');
    });

</script>
@endpush



