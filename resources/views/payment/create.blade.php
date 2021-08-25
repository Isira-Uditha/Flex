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

                    <form  method="POST" class="login-form">
                        @csrf

                        <div class="panel panel-primary tabs-style-3">

                            <div class="tab-menu-heading">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-user"></i> &nbsp;Step 1 - Personal Information</a></li>
                                        <li><a href="#tab12" data-toggle="tab"><i class="fa fa-credit-card"></i> &nbsp;Step 2 - Payment Information</a></li>
                                        <li><a href="#tab13" data-toggle="tab"><i class="fab fa-leanpub"></i> &nbsp;Step 3 - Summary</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab11">
                                        <div class="row d-flex justify-content-center">

                                            <div class="col-md-4">

                                                <div class="form-group @error('uid') has-danger @enderror mb-4">
                                                    <label>User ID</label>
                                                    <input class="form-control" placeholder="Enter your uid" type="text"
                                                        name="uid" readonly>
                                                    @error('uid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group @error('email') has-danger @enderror mb-4">
                                                    <label>User Email</label>
                                                    <input class="form-control" placeholder="Enter your email" type="text"
                                                        name="email" readonly>
                                                    @error('email')
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
                                                        name="name" readonly>
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
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab12">
                                        <p> Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. </p>
                                        <p class="mb-0">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                                    </div>

                                    <div class="tab-pane" id="tab13">
                                        <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae</p>
                                        <p class="mb-0">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. </p>
                                    </div>

                                    <div class="tab-pane" id="tab14">
                                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire</p>
                                        <p class="mb-0">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus </p>
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

});
</script>
@endpush
