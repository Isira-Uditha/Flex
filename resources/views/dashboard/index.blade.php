@extends('layouts.default')

@push('styles')
<style>

    .justify {
      text-align: justify;
      text-justify: inter-word;
    }

    .hover:hover{
        transform: scale(1.04);
        transition: transform .7s;
    }

    .hover{
        transform: scale(1);
        transition: transform .7s;
    }

    img {
        display: inline-block;
        border-radius: 60px;
        box-shadow: 0px 0px 2px rgb(187, 81, 152);
        padding: 0.5em 0.6em;
    }

    .scard {
        background: rgba(255, 255, 255, 0.4) !important;
    }

</style>
@endpush

@section('title','Dashboard')
@section('sub_title','')

@section('content')

@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp

<div class="row">
    <div class="col-md-12">

        <div class="custom-card">
            <div class="card-body">
                <h6 class="card-title mb-0"></h6>
                <div class="row row-sm">
                    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                        <div class="card bg-primary-gradient text-white hover">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon1 mt-2 text-center">
                                            <i class="far fa-clock tx-40"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="mt-0 text-center">
                                            <span class="text-white">Workouts <label class="text-white">({{date('Y/M')}})</label></span>
                                            <h2 class="text-white mb-0 counter">{{$data['app_count']}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                        <div class="card bg-danger-gradient text-white hover">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon1 mt-2 text-center">
                                            <i class="fe fe-users tx-40"></i>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mt-0 text-center">
                                            <span class="text-white">BMI <label class="text-white">(Kgm<sup>-2</sup>)</label></span>
                                            <h2 class="text-white mb-0 counter">{{$data['bmi']['bmi']}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                        <div class="card bg-success-gradient text-white hover">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon1 mt-0 text-center">
                                            <i class="typcn typcn-heart-half-outline tx-40"></i>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mt-0 text-center">
                                            <span class="text-white">Health</span>
                                            <p class="text-white tx-11 mb-0">({{$data['bmi']['bmi_type']}})</p>
                                            <h4 class="text-white mb-0"> @if($data['bmi']['bmi_type'] == 'Normal weight'){{'Healthy'}}@else {{'Not Healthy'}} @endif</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                        <div class="card bg-warning-gradient text-white hover">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon1 mt-2 text-center">
                                            <i class="fas fa-dollar-sign tx-40"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="mt-0 text-center">
                                            <span class="text-white">Payment Status</span>
                                            <p class="text-white tx-11 mb-0">({{date('Y/M')}})</p>
                                            <h4 class="text-white mb-0">@if($data['payment'] == 1) Paid @else Not Paid @endif</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="card-title pb-0  mb-3">Monthly Progress</div>
                <p class="tx-12 tx-gray-500 mb-3 justify">Resistance training increases muscle strength by making your muscles work ... Once you can comfortably complete <b>15 reps</b> of an exercise per month. And it required to do at least an average of <b>60 minutes per day</b> of moderate-to-vigorous intensity, mostly aerobic, physical activity, across the week.
                    Plain and simple, the order of your exercise movements is actually one of the defining factors in how effective your workout regimen is.</p><p class="tx-12 tx-gray-500 mb-3 justify"><b>If you remember one thing, make it this:</b> Do more technical, harder, full-body movements before the smaller-muscle-focused accessory work, &nbsp;<a href="">Learn more</a></p>
            </div>
            <div class="card-body hover">
                <div class="row">
                    <div class="col text-center">
                        <label class="tx-12">Total Workouts</label>
                        <p class="font-weight-bold tx-20 counter">15</p>
                    </div>
                    <div class="col border-left text-center">
                        <label class="tx-12">Completed Workouts</label>
                        <p class="font-weight-bold tx-20 counter">{{$data['app_count']}}</p>
                    </div>
                    <div class="col border-left text-center">
                        <label class="tx-12">More to Go</label>
                        <p class="font-weight-bold tx-20 counter">@if($data['app_count'] <= 15) {{15 - $data['app_count']}} @else 0 @endif</p>
                    </div>
                </div>
                <div class="progress mt-3">
                    @php
                        if($data['app_count'] <= 15){
                            $precent = number_format((float)($data['app_count']/15)*100, 2, '.', '');
                        }else {
                            $precent = '100';
                        }
                    @endphp
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: {{$precent}}%; height: 20px;">{{$precent}} %</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    BIM variation
                </div>
                <div class="chartjs-wrapper-demo hover">
                    <canvas id="chartLine1" class="mt-2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center mt-4">
    <div class="col-sm-3">
        <div class="card h-100 border-primary hover scard">
            <div class="card-body text-center">
                <img src="{{asset('/images/gym/gym.png')}}" class="ht-90 mb-4" alt="gym.png"/>
                <h5 class="card-title text-primary">Workout Plans</h5>
                <hr class="bg-primary" />
                <p class="card-text text-muted text-justify">Fitness tests are often used by trainers to analyze their clients' strengths and weaknesses. These fitness evaluations can be done both before and after an exercise program. Individualized workouts will be provided to each participant by us .We guarantee you that every workout plan used and provided here will be of the highest standard.</p>
            </div>
            <div class="card-footer text-center scard">
                <a href="#" class="btn btn-primary">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card h-100 border-success hover scard">
            <div class="card-body text-center ">
                <div class=""><img src="{{asset('/images/gym/dumbbell.png')}}" class="ht-90 mb-4" alt="dumbbell.png"/></div>
                <h5 class="card-title text-success">Equipment</h5>
                <hr class="bg-success" />
                <p class="card-text text-muted text-justify">New Equipment Digest is a print and digital publication that provides readers at tens of thousands of facilities with the most up-to-date industrial product information, industry trends, and manufacturing news. So we maintain and provide best and standard equipment for each workout exercises with high confidentiality.</p>
            </div>
            <div class="card-footer text-center scard">
                <a href="#" class="btn btn-success">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card h-100 border-warning hover scard">
            <div class="card-body text-center">
                <img src="{{asset('/images/gym/nutrition.png')}}" class="ht-90 mb-4" alt="nutrition.png"/>
                <h5 class="card-title text-warning">Diet Plans</h5>
                <hr class="bg-warning" />
                <p class="card-text text-muted text-justify">To get the most out of all of your hard work in the gym, you'll need to match your nutrition. Do you consume enough protein at the appropriate times? What about the correct pre- and post-workout vitamins and meals? Our Flex Gymnasium offers you accurate and medical standards dite plans for every BMI category.</p>
            </div>
            <div class="card-footer text-center scard">
                <a href="#" class="btn btn-warning">Learn more</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 hover">
    <div class="col-md-2"></div>
    <div class="col-lg-8">
        <div class="custom-card">
            <div class=" custom-card-header">
                <h6 class="card-title mb-0"></h6>
            </div>
            <div class="card-body">
                <div class="vtimeline">
                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-secondary">
                        <div class="timeline-badge"><i class="la la-utensils"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h6 class="timeline-title">Eat</h6>
                            </div>
                            <div class="timeline-body">
                                <p>You Need More Strength.</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-wrapper timeline-wrapper-info">
                        <div class="timeline-badge">&nbsp;&nbsp;<i class="icon ion-md-walk"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h6 class="timeline-title">Exercise</h6>
                            </div>
                            <div class="timeline-body">
                                <p>You Need To Be Smart.</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-wrapper timeline-inverted timeline-wrapper-warning">
                        <div class="timeline-badge success"><i class="fa fa-bed"></i> </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h6 class="timeline-title">Sleep</h6>
                            </div>
                            <div class="timeline-body">
                                <p>You Need To Be Healthy.</p>
                            </div>
                            <div class="timeline-body">
                                <div class="embed-responsive embed-responsive-16by9 mb-3">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/c06dTj0v0sM?rel=0&amp;controls=0&amp;showinfo=0"
                                     allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-wrapper timeline-wrapper-success">
                        <div class="timeline-badge"><i class="las la-check-circle"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h6 class="timeline-title">Repeat</h6>
                            </div>
                            <div class="timeline-body">
                                <p>Because This Is What You Love To Do!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

@endsection



@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script>
$(document).ready(function () {
    $(".counter").counterUp({
        delay: 10,
        time: 1200
    });

    $.ajax({
        type: "GET",
        url: "{{route('getBMIValues')}}",
        success: function (response) {
            createChart(response.data);
        }
    });


    function createChart(data){
        var labels = (data.appointment_date).map(a => a.appointment_date);
        var data = (data.bmi).map(a => a.bmi);
        var ctx = document.getElementById('chartLine1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'BMI',
                    data: data,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }


});
</script>
<script>

</script>
@endpush
