@push('styles')
<style>
    .side-menu .slide.active .side-menu__label, .side-menu .slide.active .side-menu__icon{
        color: #8ad8ff !important;
    }
</style>
@endpush
@php
    $gender = Auth::user()->gender;
@endphp
<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{url('/')}}"><img src="{{ asset('images/bg_img.png') }}"
                class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{url('/')}}"><img src="{{asset('images/bg_img.png')}}"
                class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{url('/')}}"><img
                src="../../assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{url('/')}}"><img
                src="../../assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if ($gender == 'Female')
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{asset('assets/img/faces/woman.png')}}"><span
                            class="avatar-status profile-status bg-green"></span>
                    @else
                        <img alt="user-img" class="avatar avatar-xl brround" src="{{asset('assets/img/faces/man.png')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                    @endif
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::user()-> first_name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->role }}</span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="{{route('dashboard')}}"><i class="fe fe-layers"></i>&nbsp;&nbsp;<span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-book-open"></i>&nbsp;&nbsp;<span class="side-menu__label">Booking</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{route('appointment_index')}}">Appointment</a></li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-credit-card"></i>&nbsp;&nbsp;<span class="side-menu__label">Payment</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{route('payment_index')}}">Monthly Payment</a></li>
                </ul>
            </li>
            @if (Auth::user()->role != 'Member')
                <li class="slide">
                    <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-book-open"></i>&nbsp;&nbsp;<span class="side-menu__label">WorkOut Plans</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('workout_plan_index')}}">WorkOut Plans</a></li>
                        <li><a class="slide-item" href="{{url('/workout/workout_exercise')}}">WorkOut Exercises</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-book-open"></i>&nbsp;&nbsp;<span class="side-menu__label">Diet Plans</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('diet_plan_index')}}">Diet Plans</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-package"></i>&nbsp;&nbsp;<span class="side-menu__label">Package</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('package_index')}}">Active Packages</a></li>
                        <li><a class="slide-item" href="{{route('package_view',['action' => 'Summary'])}}">Summary</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-users"></i>&nbsp;&nbsp;<span class="side-menu__label">Users</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="#">Members</a></li>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('user_index',['u_type' => 'Member'])}}">Current Members</a></li>
                            <li><a class="slide-item" href="#">Summary</a></li>
                        </ul>
                        <li><a class="slide-item" href="#">Employees</a></li>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{route('user_index',['u_type' => 'Employee'])}}">Current Employees</a></li>
                            <li><a class="slide-item" href="#">Summary</a></li>
                        </ul>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item text-white" data-toggle="slide" href="#"><i class="fe fe-book-open"></i>&nbsp;&nbsp;<span class="side-menu__label">Equipment</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{route('equipment_index')}}">View Equipment</a></li>
                    </ul>
                </li>
            @endif
            <li class="slide">
                <a class="side-menu__item text-white" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span><i class="bx bx-log-out"></i></span>&nbsp;&nbsp;<span
                    class="side-menu__label">Sign Out</span></a>
                    <form id="logout-form" action="{{url('/logout')}}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
