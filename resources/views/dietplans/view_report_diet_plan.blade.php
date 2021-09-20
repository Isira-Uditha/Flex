@extends('layouts.default')

@push('styles')

@endpush

@section('title','Diet Plan')
@section('sub_title','Report')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp



<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">

            <div class="card-body">

                <h6 class="card-title mb-1">Usage of Diet Plans including the total number of users currently in Use</h6>
                    <div class="form-group col-md-12">
                        <a href="{{route('diet_plan_report_print')}}" type="button" class="btn btn-secondary text-white" style="float: right">Print Report</a>
                    </div>

                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">Diet Plan ID</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Diet Plan Name</th>
                            <th scope="col">Total Users Currnetly in Use</th>
                            <th scope="col">BMI Category</th>

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
                }, {
                    data: 'user_count',
                    name: 'user_count'
                },
                {
                    data: 'bmi_category',
                    name: 'bmi_category'
                }
            ]
        });
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })


         $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var dietid = $(this).closest("a").data('dietid');
            var res = deleteDietPlan(dietid);
        });

        function deleteDietPlan(dietid){

            let url = "{{ route('diet_plan_delete', ':id') }}";
            url = url.replace(':id', dietid);

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
                        url: url,
                        data: {'_token':'{{csrf_token()}}','id':dietid},
                        success: function (response) {
                            if(response.success){
                                $('*[data-dietid="' + dietid + '"]').closest("tr").remove();
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

$('#btn_add_diet').click(function () {

    $.ajax({
          url: "{{route('check_valid_create_diet')}}",
          type: 'GET',
          success: function (response) {
            if(response.data == true){
               window.location.href = "{{route('create_dietPlan_view')}}";
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
