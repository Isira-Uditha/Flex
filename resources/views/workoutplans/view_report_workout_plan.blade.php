@extends('layouts.default')

@push('styles')

@endpush

@section('title','WorkOut Plan')
@section('sub_title','Report')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1">Usage of Workout Plans </h6>
                <div class="form-group col-md-12">
                    <a href="{{route('workout_plan_report_print')}}" type="button" class="btn btn-secondary text-white" style="float: right">Print Report</a>
                </div>
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">Workout Plan ID</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Workout Plan Name</th>
                            <th scope="col">Total Users Currnetly in Use</th>
                            <th scope="col">Number of Exerices</th>
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
                    data: 'workout_id',
                    name: 'workout_id'
                },
                {
                    data: 'created_date',
                    name: 'created_date'
                },
                {
                    data: 'workout_plan_name',
                    name: 'workout_plan_name'
                },
                 {
                    data: 'exercise_count',
                    name: 'exercise_count'
                },{
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
            var workoutid = $(this).closest("a").data('workoutid');
            console.log("Workout Id : "+ workoutid)
            var res = deleteWorkoutPlan(workoutid);
        });

        function deleteWorkoutPlan(workoutid){

                let url = "{{ route('workout_plan_delete', ':id') }}";
                url = url.replace(':id', workoutid);

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
                            data: {'_token':'{{csrf_token()}}','id':workoutid},
                            success: function (response) {
                                if(response.success){
                                    $('*[data-workoutid="' + workoutid + '"]').closest("tr").remove();
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
