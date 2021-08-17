@extends('layouts.default')

@push('styles')

@endpush

@section('title','Diet Plan')
@section('sub_title','')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Search Diet Plans</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        @csrf
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group @error('diet_plan_id') has-danger @enderror">
                                <label>Diet Plan ID</label>
                                <input class="form-control" placeholder="Search by Workout Plan ID" type="text" name="diet_plan_id">
                                @error('diet_plan_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group @error('created_date') has-danger @enderror">
                                <label class="">Created Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" onkeydown="false" name="created_date" value="{{date('m/d/Y')}}" id="created_date" type="text">
                                </div>
                                @error('created_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @error('diet_plan_name') has-danger @enderror">
                                <label>Diet Plan Name</label>
                                <input class="form-control" placeholder="Search by Diet Plan Name" type="text" name="diet_plan_name">
                                @error('diet_plan_name')
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

                                <div class="form-group @error('diet_plan_bmi_category') has-danger @enderror">
                                    <label>BMI Category</label>
                                    <select class="form-control select2" name="diet_plan_bmi_category" id="diet_plan_bmi_category">
                                        <option value="" label="Select a Category">
                                           Select a Category
                                        </option>
                                        <option value="Underweight" label="Underweight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Underweight')) selected @endif>
                                            Underweight
                                        </option>
                                        <option value="Normal weight" label="Normal weight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Normal weight')) selected @endif>
                                            Normal weight
                                        </option>
                                        <option value="Overweight" label="Overweight" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Overweight')) selected @endif>
                                            Overweight
                                        </option>
                                        <option value="Obesity" label="Obesity" @if(!empty(old('diet_plan_bmi_category') && old('diet_plan_bmi_category') == 'Obesity')) selected @endif>
                                            Obesity
                                        </option>
                                    </select>
                                    @error('diet_plan_bmi_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label>&nbsp;</label>
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
                                <input type="button" id="btn_add_diet" class="btn btn-success" value="Add Diet Plan"/>
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
                            <th scope="col">Diet Plan ID</th>
                            <th scope="col">Created Dater</th>
                            <th scope="col">Diet Plan Name</th>
                            <th scope="col">BMI Category</th>
                            <th scope="col">Breakfast</th>
                            <th scope="col">Lunch</th>
                            <th scope="col">Dinner</th>
                            <th scope="col">Description</th>
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
                    var frm = $('#form_id').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'diet_id',
                    name: 'diet_id'
                },
                {
                    data: 'created_date',
                    name: 'created_date'
                },
                {
                    data: 'diet_plan_name',
                    name: 'diet_plan_name'
                },
                {
                    data: 'bmi_category',
                    name: 'bmi_category'
                },
                {
                    data: 'breakfast',
                    name: 'breakfast'
                },
                {
                    data: 'lunch',
                    name: 'lunch'
                },
                {
                    data: 'dinner',
                    name: 'dinner'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

});




$('#btn_add_diet').click(function () {

    console.log("Clicked");
    $.ajax({
          url: "{{route('check_valid_create_diet')}}",
          type: 'GET',
          success: function (response) {

            if(response.data == true){
                console.log(response.data);
                window.location.href = "{{route('create_dietPlan_view')}}"

            }
            else{
                Swal.fire({
                icon: 'info',
                title: 'Sorry',
                text: 'System can contain only  four(4) diet plans , Please edit or delete an exisiting diet plan to continue',

                })
            }
          },
          error: function (e) {
            Swal.fire({
                icon: 'question',
                title: 'Oops',
                text: 'Some thing When wrong Please refresh and Try Again',

                })
          }
      });
});

</script>
@endpush
