@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
<link href="../../assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css"/>
@endpush

@section('title','Equipment')
@section('sub_title','View Equipment')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
            {{-- <div class="card-body"> --}}
                {{-- <div> --}}
                    {{-- <h6 class="card-title mb-1">Register Equipment</h6> --}}

                    <form action="{{route('createEquipment')}}" method="POST" class="login-form" enctype="multipart/form-data" id="create_equipment">
                        @csrf
                        <div class="card-body">
                            <h6 class="card-title mb-3">Register Equipment</h6>
                        <div class="row row-sm">
                            <div class="col-6">
                                <div class="form-group @error('equipment_code') has-danger @enderror">
                                    <label class="form-label">Equipment Code: </label>
                                    <input class="form-control" name="equipment_code" id="equipment_code" placeholder="Input Equipment Code"  type="text"
                                     value="{{$data['result']->equipment_code}}" readonly>
                                    @error('equipment_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('category') has-danger @enderror">
                                    <label class="form-label">Equipment Category: </label>
                                    <select class="form-control select2" name="category" id="category" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one"
                                    @if(!empty(old('category'))) value="{{old('category')}}" @else value="" @endif>
                                        <option value="Select a Category" label="Select a Category">
                                            Select a Category
                                        </option>
                                        <option value="Fitness & Body Building" label="Fitness & Body Building" @if(!empty(old('category') && old('category') == 'Fitness & Body Building')) selected @endif>
                                            Fitness & Body Building
                                        </option>
                                        <option value="Team Sport" label="Team Sport" @if(!empty(old('category') && old('category') == 'Team Sport')) selected @endif>
                                            Team Sport
                                        </option>
                                        <option value="Sport Safety" label="Sport Safety" @if(!empty(old('category') && old('category') == 'Sport Safety')) selected @endif>
                                            Sport Safety
                                        </option>
                                        <option value="Gym Equipment" label="Gym Equipment" @if(!empty(old('category') && old('category') == 'Gym Equipment')) selected @endif>
                                            Gym Equipment
                                        </option>
                                        <option value="Outdoor Sports" label="Outdoor Sports" @if(!empty(old('category') && old('category') == 'Outdoor Sports')) selected @endif>
                                            Outdoor Sports
                                        </option>
                                        <option value="Indoor Sports" label="Indoor Sports" @if(!empty(old('category') && old('category') == 'Indoor Sports')) selected @endif>
                                            Indoor Sports
                                        </option>
                                        <option value="Sports Gloves" label="Sports Gloves" @if(!empty(old('category') && old('category') == 'Sports Gloves')) selected @endif>
                                            Sports Gloves
                                        </option>
                                        <option value="Swimming & Diving" label="Swimming & Diving" @if(!empty(old('category') && old('category') == 'Swimming & Diving')) selected @endif>
                                            Swimming & Diving
                                        </option>
                                        <option value="Supplements" label="Supplements" @if(!empty(old('category') && old('category') == 'Supplements')) selected @endif>
                                            Supplements
                                        </option>
                                        <option value="Other Sports Equipment" label="Other Sports Equipment" @if(!empty(old('category') && old('category') == 'Other Sports Equipment')) selected @endif>
                                            Other Sports Equipment
                                        </option>
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('equipment_price') has-danger @enderror">
                                    <label class="form-label">Price(Rs.): <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="equipment_price" id="equipment_price" placeholder="Input Price"  type="text"
                                    @if(!empty(old('equipment_price'))) value="{{old('equipment_price')}}" @else value="" @endif>
                                    @error('equipment_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group @error('equipment_name') has-danger @enderror">
                                    <label class="form-label">Equipment Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="equipment_name" id="equipment_name" placeholder="Input Equipment Name"  type="text"
                                    @if(!empty(old('equipment_name'))) value="{{old('equipment_name')}}" @else value="" @endif>
                                    @error('equipment_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" @error('registered_date') has-danger @enderror>
                                <label class="form-label">Registered Date: <span class="tx-danger">*</span></label>
                                <div class="row row-sm ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div><input class="form-control fc-datepicker" name="registered_date" id="registered_date" placeholder="MM/DD/YYYY" type="text"
                                        @if(!empty(old('registered_date'))) value="{{old('registered_date')}}" @else value="" @endif>
                                        @error('registered_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                </div>

                                <div class="form-group" @error('status') has-danger @enderror>
                                    <label class="form-label">Status: </label>
                                    <select class="form-control select2" data-parsley-class-handler="#slWrapper" name="status" id="status" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one">
                                        <option label="Select Status">
                                            Select Status
                                        </option>
                                        <option value="In Use" label="In Use" @if(!empty(old('status') && old('status') == 'In Use')) selected @endif>
                                            In Use
                                        </option>
                                        <option value="Repair" label="Repair" @if(!empty(old('status') && old('status') == 'Repair')) selected @endif>
                                            Repair
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group @error('image') has-danger @enderror">
                            <label for="image">Equipment Image <span class="tx-danger">*</span></label>
                            {{-- <input type="file" class="form-control" name="image" id="image"> --}}
                            <div class="col-md-8">
                                <input type="file" name="image" id="image" data-allowed-file-extensions="jpg png"  class="dropify form-control" data-height="200" />
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('muscles_used') has-danger @enderror">
                            <label>Muscles Used <span class="tx-danger">*</span></label>
                                <textarea class="form-control" placeholder="Describe Muscles Used" name="muscles_used" id="muscles_used" rows="3">
                                @if(!empty(old('muscles_used'))) {{old('muscles_used')}} @elseif(isset($data['result'])) {{$data['result']->muscles_used}} @else  @endif</textarea>
                            @error('muscles_used')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('equipment_desc') has-danger @enderror">
                            <label>Equipment Description <span class="tx-danger">*</span></label>
                                <textarea class="form-control" placeholder="Enter Equipment Description" name="equipment_desc" id="equipment_desc" rows="3">
                                    @if(!empty(old('equipment_desc'))) {{old('equipment_desc')}} @elseif(isset($data['result'])) {{$data['result']->equipment_desc}} @else  @endif
                                </textarea>
                            @error('equipment_desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0">Register</button> --}}
                            <label>&nbsp;</label>
                        </div>
                        </div>

                        <div class="card-footer w-100" style="position: absolute; bottom: 0;">
                            <div class="row">

                                <div class="col-md-6 text-left">
                                    <div class="form-group col-md-12">
                                        {{-- <button type="button" id="search" class="btn btn-primary" data-placement="top" data-toggle="tooltip-primary" title="Appointment date and Time slot are required.">Cehck Availability</button>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-question-circle fa-lg" data-placement="top" data-toggle="tooltip-primary" title="Please select an appointment date and time slot to check the availability."></i> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit" class="btn btn-success">Register</button>
                                        <button type="reset" id="clear" class="btn btn-secondary text-white">Clear</button>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </form>
                {{-- </div>
            </div> --}}
        </div>
    </div>
</div>



@endsection



@push('scripts')
<script>
$(document).ready(function () {
$('#clear').click(function (e) {
    e.preventDefault();
    clear();
});

});

function clear(){
    $('.select2').val('');
    $('.select2').trigger('change');
    $('input[type=text]').val('');
    $('textarea').val('');
    $(".dropify-clear").trigger('click');
}



</script>
@endpush

