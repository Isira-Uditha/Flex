@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
<link href="../../assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css"/>
@endpush

@section('title','Equipment')
@section('sub_title','Register Equipment')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-1">Register Equipment</h6>

                    <form action="{{route('createEquipment')}}" method="POST" class="login-form" enctype="multipart/form-data" id="create_equipment">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-6">
                                <div class="form-group @error('equipment_code') has-danger @enderror">
                                    <label class="form-label">Equipment Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="equipment_code" id="equipment_code" placeholder="Input Equipment Code"  type="text"
                                    @if(!empty(old('equipment_code'))) value="{{old('equipment_code')}}" @else value="" @endif>
                                    @error('equipment_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('category') has-danger @enderror">
                                    <label class="form-label">Equipment Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="category" id="category" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one"
                                    @if(!empty(old('category'))) value="{{old('category')}}" @else value="" @endif>
                                        <option value="" label="Select a Category">
                                            Select a Category
                                        </option>
                                        <option value="In Use" label="In Use">
                                            In Use
                                        </option>
                                        <option value="Repair" label="Repair">
                                            Repair
                                        </option>
                                        <option value="Sport Safety" label="Sport Safety">
                                            Sport Safety
                                        </option>
                                        <option value="Gym Equipment" label="Gym Equipment">
                                            Gym Equipment
                                        </option>
                                        <option value="Outdoor Sports" label="Outdoor Sports">
                                            Outdoor Sports
                                        </option>
                                        <option value="Indoor Sports" label="Indoor Sports">
                                            Indoor Sports
                                        </option>
                                        <option value="Sports Gloves" label="Sports Gloves">
                                            Sports Gloves
                                        </option>
                                        <option value="Swimming & Diving" label="Swimming & Diving">
                                            Swimming & Diving
                                        </option>
                                        <option value="Supplements" label="Supplements">
                                            Supplements
                                        </option>
                                        <option value="Other Sports Equipment" label="Other Sports Equipment">
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
                                    <label class="form-label">Price: <span class="tx-danger">*</span></label>
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
                                    <label class="form-label">Status: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-parsley-class-handler="#slWrapper" name="status" id="status" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one"
                                    @if(!empty(old('status'))) value="{{old('status')}}" @else value="" @endif>
                                        <option label="Select Status">
                                            Select Status
                                        </option>
                                        <option value="In Use" label="In Use">
                                            In Use
                                        </option>
                                        <option value="Repair" label="Repair">
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
                            <label for="image">Equipment Image (please upload 270 x 355 size)</label>
                            {{-- <input type="file" class="form-control" name="image" id="image"> --}}
                            <div class="col-md-8">
                                <input type="file" name="image" id="image" class="dropify form-control" data-height="200" />
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('muscles_used') has-danger @enderror">
                            <label>Muscles Used</label>
                                <textarea class="form-control" placeholder="Describe Muscles Used" name="muscles_used" id="muscles_used" rows="3"
                                @if(!empty(old('muscles_used'))) value="{{old('muscles_used')}}" @else value="" @endif></textarea>
                            @error('muscles_used')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('equipment_desc') has-danger @enderror">
                            <label>Description</label>
                                <textarea class="form-control" placeholder="Enter Meals for Dinner" name="equipment_desc" id="equipment_desc" rows="3"
                                @if(!empty(old('equipment_desc'))) value="{{old('equipment_desc')}}" @else value="" @endif></textarea>
                            @error('equipment_desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-primary mt-3 mb-0">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection



@push('scripts')
<script>
$(document).ready(function () {
// $('#submit').click(function (e) {
//     e.preventDefault();
//     alert(' xxxxxx');
// });

$(document).ready(function () {

});

});
</script>
@endpush

