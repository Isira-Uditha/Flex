@extends('layouts.default')

@push('styles')

@endpush

@section('title','Equipment')
@section('sub_title','view Report')

@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">

                <div class="card-body">

                    <h6 class="card-title mb-1">Equipment Category Report</h6>
                        <div class="form-group col-md-12">
                            <a href="{{route('equipment_report_print')}}" type="button" class="btn btn-secondary text-white" style="float: right">Print Report</a>
                        </div>

                        <table class="table" id="zero_config">
                            <thead>
                                <tr>
                                    <th scope="col">Equipment Category</th>
                                    <th scope="col">Equipment Count</th>
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
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'equipment_count',
                    name: 'equipment_count'
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
            var eqpid = $(this).closest("a").data('eqpid');
            var res = deleteEquipment(eqpid);

        });

        function deleteEquipment(eqpid){
            console.log("iiiiii"+eqpid);
            let url = "{{ route('equipment_delete', ':id') }}";
            url = url.replace(':id', eqpid);
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
                        data: {'id':eqpid,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success){
                                $('*[data-eqpid="' + eqpid + '"]').closest("tr").remove();
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
