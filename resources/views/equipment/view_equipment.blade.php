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
                    <form action="{{route('createEquipment')}}" method="POST" class="login-form" enctype="multipart/form-data" id="create_equipment">
                        @csrf
                        <div class="card-body">
                            <span>
                            </span>
                            <div class="row row-sm">
                                <div class="col-5">
                                    <div class="form-group @error('image') has-danger @enderror">
                                        <div class="col-md-8">
                                        @php
                                            $img = Storage::disk('accountsdocs')->get($data['result']->image);
                                            $type =  pathinfo(Storage::disk('accountsdocs')->path($data['result']->image), PATHINFO_EXTENSION);
                                            $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
                                        @endphp
                                            <img src="{{$path}}" alt="{{asset(Storage::disk('accountsdocs')->path($data['result']->image))}}" height="350px">
                                        </div>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-7 table-responsive">

                                    <table class="table mg-b-0 text-md-nowrap table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>Equipment Code</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->equipment_code}}</td>
                                            </tr>
                                            <tr>
                                                <th>Equipment Name</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->equipment_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>category</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->category}}</td>
                                            </tr>
                                            <tr>
                                                <th>Price(Rs.)</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->equipment_price}}</td>
                                            </tr>
                                            <tr>
                                                <th>Registered Date</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->registered_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td class="text-right">:</td>
                                                <td class="text-left">{{$data['result']->status}}</td>
                                            </tr>
                                            <tr>
                                                <th>Muscles Used</th>
                                                <td class="text-right">:</td>
                                                <td class="text-justify">{{$data['result']->muscles_used}}</td>
                                            </tr>
                                            <tr>
                                                <th>Equipment Description</th>
                                                <td class="text-right">:</td>
                                                <td class="text-justify">{{$data['result']->equipment_desc}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <div class="form-group col-md-12">
                                        <a href="{{route('equipment_index')}}" type="button" id="add" class="btn btn-success">OK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

