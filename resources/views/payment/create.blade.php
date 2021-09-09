@extends('layouts.default')

@push('styles')

@endpush

@section('title','Payment')
@section('sub_title','Make Payments')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-3">Make Payemts</h6>

                    <form action="{{route('payment_create',['action' => 'Add', 'id' => ''])}}"  method="POST" class="login-form" id="form_id">
                        @csrf

                        <div class="panel panel-primary tabs-style-3">

                            <div class="tab-menu-heading">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class=""><a href="#tab11" id="li11" class="active" data-toggle="tab"><i class="fa fa-user"></i> &nbsp;Step 1 - Personal Information</a></li>
                                        <li><a href="#tab12" id="li12" data-toggle="tab"><i class="fab fa-leanpub"></i> &nbsp;Step 2 - Payment Summary</a></li>
                                        <li><a href="#tab13" id="li13" data-toggle="tab"><i class="fa fa-credit-card"></i> &nbsp;Step 3 - Payment Information</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab11">

                                        <div class="row d-flex justify-content-center mb-4 mt-4">
                                            <div class="col-md-4">
                                                <div class="form-group @error('uid') has-danger @enderror mb-4">
                                                    <label>User ID</label>
                                                    <input class="form-control" placeholder="Enter your uid" type="text"
                                                        name="uid" id="uid" value="{{$data['user']->uid}}" readonly>
                                                    @error('uid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('email') has-danger @enderror mb-4">
                                                    <label>User Email</label>
                                                    <input class="form-control" placeholder="Enter your email" type="text"
                                                        name="email" id="email" value="{{$data['user']->email}}" readonly>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('package_id') has-danger @enderror mb-4">
                                                    <label>Package Type</label>
                                                    <span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="" data-original-title="Required">&nbsp; *</span>
                                                    <select class="form-control select2" name="package_id" id="package_id">
                                                        <option label="Choose one" value="">
                                                            Choose one
                                                        </option>
                                                        @foreach ($data['packages'] as $res)
                                                            <option value="{{$res->package_id}}" @if(isset($data['package_id']) && $data['package_id'] == $res->package_id) selected @endif>
                                                                {{$res->package_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('package_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-4">
                                                <div class="form-group @error('name') has-danger @enderror mb-4">
                                                    <label>User Name</label>
                                                    <input class="form-control" placeholder="Enter your name" type="text"
                                                        name="name" id="name" value="{{Str::title($data['user']->first_name .' '. $data['user']->last_name)}}" readonly>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('date') has-danger @enderror mb-4">
                                                    <label class="">Current Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                            </div>
                                                        </div><input class="form-control fc-datepicker" onkeydown="false" name="date" value="{{date('m/d/Y')}}" id="date" type="text" readonly>
                                                    </div>
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('package_price') has-danger @enderror mb-4">
                                                    <label>Package Price</label>
                                                    <input class="form-control" placeholder="Enter your package_price" type="text"
                                                        name="package_price" id="package_price" readonly>
                                                    @error('package_price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><br/>

                                        <div class="row card-footer mt-3">
                                            <div class="col-md-12 text-right">
                                                <div class="form-group col-md-12">
                                                    <input data-toggle="tab" type="button" class="btn btn-primary mt-3 text-right" value=" Next" id="next_1">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="tab12">

                                        <div class="table-responsive mg-t-20 d-flex justify-content-center mb-4">
                                            <table class="table table-bordered wd-1000">
                                                <tbody>
                                                    <tr>
                                                        <td>User Name</td>
                                                        <td class="text-right text-muted">{{Str::title($data['user']->first_name .' '. $data['user']->last_name)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>User Email</td>
                                                        <td class="text-right text-muted">{{$data['user']->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Current Date</td>
                                                        <td class="text-right text-muted">{{date('m/d/Y')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Package Price</span></td>
                                                        <td class="text-right text-muted" id="td_package_price"><span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="h4">Total</span></td>
                                                        <td><h3 class="price text-right mb-0" id="td_total_price"></h3></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><br/>

                                        <div class="row card-footer mt-3">
                                            <div class="form-group col-md-6 text-left">
                                                <input data-toggle="tab" type="button" class="btn btn-secondary mt-3 text-left" value=" Back" id="back_2">
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="form-group col-md-12">
                                                    <input data-toggle="tab" type="button" class="btn btn-primary mt-3 text-right" value=" Next" id="next_2">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="tab13">
                                        <div class="row d-flex justify-content-center mb-5 mt-4">
                                            <div class="col-md-4">

                                                <div class="form-group @error('card_name') has-danger @enderror mb-4">
                                                    <label>CardHolder Name</label>
                                                    <span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="" data-original-title="Required">&nbsp; *</span>
                                                    <input class="form-control" placeholder="Enter the name on card" type="text"
                                                        name="card_name" id="card_name">
                                                    @error('card_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="form-label">Expiration <span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="" data-original-title="Required">&nbsp; *</span></label>
                                                    <div class="input-group">
                                                        <div class="form-group @error('expiremonth') has-danger @enderror mb-4 mr-2">
                                                            <input type="number" class="form-control" placeholder="MM" name="expiremonth">
                                                            @error('expiremonth')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('expiremonth') has-danger @enderror mb-4">
                                                            <input type="number" class="form-control" placeholder="YY" name="expireyear">
                                                            @error('expiremonth')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group @error('total') has-danger @enderror mb-4">
                                                    <label>Total Amount</label>
                                                    <input class="form-control" type="text"
                                                        name="total" id="total" readonly>
                                                    @error('total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-1"></div>

                                            <div class="col-md-4">

                                                <div class="form-group @error('card_number') has-danger @enderror mb-4">
                                                    <label>Card Number</label>
                                                    <span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="" data-original-title="Required">&nbsp; *</span>
                                                    <div class="input-group">
                                                    <input class="form-control" placeholder="Enter your card number" type="number"
                                                        name="card_number" id="card_number">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-info" type="button"><i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp;
                                                        <i class="fab fa-cc-mastercard"></i></button>
                                                    </span>
                                                    </div>
                                                    @error('card_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group @error('cvv') has-danger @enderror mb-4">
                                                    <label class="form-label">CVV <i class="fa fa-question-circle"></i>
                                                        <span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="" data-original-title="Required">&nbsp; *</span>
                                                    </label>
                                                    <input class="form-control" placeholder="Enter cvv" type="number"
                                                        name="cvv" id="cvv">
                                                    @error('cvv')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row card-footer mt-3">
                                            <div class="form-group col-md-6 text-left">
                                                <input data-toggle="tab" type="button" class="btn btn-secondary mt-3 text-left" value=" Back" id="back_3">
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="form-group col-md-12">
                                                    <input type="button" class="btn btn-success mt-3 text-right" value=" Submit" id="submit">
                                                    <input type="submit" id="submit1" hidden>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

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
    getPackagePrice();
    $('#package_id').change(function (e) {
        e.preventDefault();
        getPackagePrice();
    });

    $('#next_1').click(function (e) {
        e.preventDefault();
        $('#li12').addClass("active");
        $('#li11,#li13').removeClass("active");
        $("#next_1").attr("href", "#tab12");
        $("#next_1").removeClass("active");
    });

    $('#next_2').click(function (e) {
        e.preventDefault();
        $('#li13').addClass("active");
        $('#li11,#li12').removeClass("active");
        $("#next_2").attr("href", "#tab13");
        $("#next_2").removeClass("active");
    });

    $('#back_3').click(function(e) {
            e.preventDefault();
            $('#li12').addClass("active");
            $('#li11,#li13').removeClass("active");
            $("#back_3").attr("href", "#tab12");
            $("#back_3").removeClass("active");
    });

    $('#back_2').click(function(e) {
            e.preventDefault();
            $('#li11').addClass("active");
            $('#li12,#li13').removeClass("active");
            $("#back_2").attr("href", "#tab11");
            $("#back_2").removeClass("active");
    });

    $('#submit').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to proceed?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed!',
            cancelButtonText: 'No, Cancel it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#submit1').trigger('click');
                }
            })
    });

});

function getPackagePrice(){
    $.ajax({
            type: "GET",
            url: "{{route('getPackagePrice')}}",
            data: $('#form_id').serializeArray(),
            success: function (response) {
                $('#package_price').val('Rs. ' + response.data.package_price);
                $('#td_package_price').text('Rs. ' + response.data.package_price);
                $('#td_total_price').text('Rs. ' + response.data.package_price);
                $('#total').val('Rs. ' + response.data.package_price);
            }
        });
}
</script>
@endpush
