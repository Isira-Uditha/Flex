@extends('layouts.default')

@push('styles')

@endpush

@section('title','Package')
@section('sub_title', 'Active Packages')

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
                <h6 class="card-title mb-1">Search Packages</h6>
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
                                <a href="{{route('package_view',['action' => 'Add', 'id' => ''])}}" type="button" class="btn btn-success">Add Package</a>
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
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            order: false,
            ajax: {
                url: "{{url()->current()}}",
                "type": "GET",
                "data": function (d) {
                    var frm = $('#form_id').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'package_id',
                    name: 'package_id'
                },
                {
                    data: 'package_name',
                    name: 'package_name'
                },
                {
                    data: 'package_description',
                    name: 'package_description'
                },
                {
                    data: 'package_duration',
                    name: 'package_duration'
                },
                {
                    data: 'package_price',
                    name: 'package_price'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $('#submit').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var appid = $(this).closest("a").data('appid');
            var res = deletePackage(appid);
        });

        function deletePackage(appid){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('package_create',['action' => 'Delete','id' =>"appid"])}}",
                        data: {'id':appid,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success){
                                $('*[data-appid="' + appid + '"]').closest("tr").remove();
                                Swal.fire(
                                'Deleted!',
                                'Record has been deleted successfully.',
                                'success'
                                );
                            }
                        }
                    });
                }
            });
        }
});

</script>
@endpush

