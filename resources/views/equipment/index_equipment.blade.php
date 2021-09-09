@extends('layouts.default')

@push('styles')

@endpush

@section('title','Equipment')
@section('sub_title','View Equipment')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Search Equipment</h6>
                    <form  method="POST" class="login-form" id="search_equipment">
                        @csrf
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group @error('equipment_name') has-danger @enderror">
                                <label>Equipment Name:</label>
                                <input class="form-control" placeholder="Search by Equipment Name" type="text" name="equipment_name">
                                @error('equipment_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group @error('registered_date') has-danger @enderror">
                                <label class="">Registered Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" onkeydown="false" name="registered_date" value="{{date('m/d/Y')}}" id="registered_date" type="text">
                                </div>
                                @error('registered_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group @error('category') has-danger @enderror">
                                <label>Select a Category</label>
                                <select class="form-control select2" name="category">
                                    <option value="" label="Select a Category">
                                        Select a Category
                                    </option>
                                    <option value="Fitness & Body Building" label="Fitness & Body Building">
                                        Fitness & Body Building
                                    </option>
                                    <option value="Team Sport" label="Team Sport">
                                        Team Sport
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

                            <div>
                                <label>&nbsp;</label>
                            </div>

                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="sts_date" id="sts_date" checked
                                        {{ old('sts_date') ? 'checked' : '' }}>
                                    <span>{{ __('Ignore Date') }}</span>
                                </label>
                            </div>

                        </div>

                        <div class="col-md-4">

                        <div class="form-group @error('equipment_code') has-danger @enderror">
                            <label>Equipment Code:</label>
                            <input class="form-control" placeholder="Search by Equipment Code" type="text" name="equipment_code">
                            @error('equipment_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        </div>
                    </div><br/>
                    <div class="row card-footer">
                        <div class="col-md-6 text-left">
                            <div class="form-group col-md-12">
                                <button type="submit" id="search" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('equipment_create_view')}}" type="button" id="add" class="btn btn-success">Add Equipment</a>
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
                            <th scope="col">Equipment ID</th>
                            <th scope="col">Equipment Image</th>
                            <th scope="col">Equipment Code</th>
                            <th scope="col">Equipment Name</th>
                            <th scope="col">Registered Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Equipment Price(Rs.)</th>
                            <th scope="col">Equipment Category</th>
                            <th scope="col">Muscles Used</th>
                            <th scope="col">Description</th>
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
    $('.select2').css('width','100%');
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            filter: false,
            order:false,
            responsive: true,
            ajax: {
                url: "{{url()->current()}}",
                "type": "GET",
                "data": function (d) {
                    var frm = $('#search_equipment').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'equipment_id',
                    name: 'equipment_id'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'equipment_code',
                    name: 'equipment_code'
                },
                {
                    data: 'equipment_name',
                    name: 'equipment_name'
                },
                {
                    data: 'registered_date',
                    name: 'registered_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'equipment_price',
                    name: 'equipment_price'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'muscles_used',
                    name: 'muscles_used'
                },
                {
                    data: 'equipment_desc',
                    name: 'equipment_desc'
                }
            ]
        });
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

        // $(document).on('click','.delete',function (e) {
        //     e.preventDefault();
        //     var appid = $(this).closest("a").data('appid');
        //     var res = deleteEquipment(appid);
        // });

        // function deleteEquipment(appid){
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //         }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: "POST",
        //                 url: "{{route('appointment_create',['action' => 'Delete','id' =>"appid"])}}",
        //                 data: {'id':appid,'_token':'{{csrf_token()}}'},
        //                 success: function (response) {
        //                     if(response.success){
        //                         $('*[data-appid="' + appid + '"]').closest("tr").remove();
        //                         Swal.fire(
        //                         'Deleted!',
        //                         'Record has been deleted successfully.',
        //                         'success'
        //                         );
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // }
});
</script>
@endpush
