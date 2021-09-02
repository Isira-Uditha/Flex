@extends('layouts.default')

@push('styles')

@endpush

@section('title','Payment')
@section('sub_title','Monthly Payment')

@section('content')

@php
    $months = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '11' => 'December',
];
    $years = [
        '2017',
        '2018',
        '2019',
        '2020',
        '2021',
];

@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-3">Search Payments</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group @error('payment_id') has-danger @enderror">
                                <label>Payment No</label>
                                <input class="form-control" placeholder="Enter your payment no" type="text"
                                    name="payment_id">
                                @error('payment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group @error('payment_year') has-danger @enderror">
                                <label>Payment Year</label>
                                <select class="form-control select2" name="payment_year">
                                    <option label="Choose one" value=" ">
                                        Choose one
                                    </option>
                                    @foreach ($years as $res)
                                        <option value="{{$res}}">
                                            {{$res}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="form-group @error('payment_month') has-danger @enderror">
                                <label>Payment Month</label>
                                <select class="form-control select2" name="payment_month">
                                    <option label="Choose one" value=" ">
                                        Choose one
                                    </option>
                                    @foreach ($months as $key => $res)
                                        <option value="{{$key}}">
                                            {{$res}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_month')
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
                                <button type="submit" id="search" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('payment_view',['action' => 'Add','id' => ''])}}" type="button" id="search" class="btn btn-success">Make Payments</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

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
                            <th scope="col">Payment No</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Paid Package</th>
                            <th scope="col">Paid Amount</th>
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

<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Payment Summary</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
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
                    data: 'payment_id',
                    name: 'payment_id'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'package_name',
                    name: 'package_name'
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
        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

        $(document).on('click','.viewPayment',function (e) {
            var id = $(this).data('id');
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{url('/payment/view/View')}}/" + id,
                success: function (response) {
                    $('.modal-body').html(response);
                }
            });

        });
});

</script>
@endpush
