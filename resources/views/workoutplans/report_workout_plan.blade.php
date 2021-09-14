@php
    use Carbon\Carbon;
    $img = public_path('images/bg_img.png');
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout Plans Usage Report</title>
    <style>
        * {
            font-size: 21px;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        html{
            margin:10px 40px 10px 40px;
        }

        .page-break {
            page-break-after: always;

        }

        * {
            font-size: 12px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .pagenum:before {
            content: counter(page);
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 150px;
            background-color: transparent;
        }

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            background-color: transparent;
        }

        .content {
            position: fixed;
            top: 13%;
            height: 68%;
            left: 0px;
            right: 0px;
            background-color: transparent;
        }

        /* #footer2 {
            position: fixed;
            left: 0px;
            bottom: -60px;
            right: 0px;
            height: 150px;
            background-color: transparent;
        } */
        #summary_table{

        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .cl3 tr {
            line-height: 180%;
        }

        #diet_plan_table th, #diet_plan_table tr td  {
            border: 1px groove black;
            padding-top: 4px;
            padding-bottom: 4px;
            text-align: center;
        }

        #diet_plan_table tr:nth-child(even){background-color: #63a1b94d;}


    </style>
</head>
    <body>
        <header style=" border: 1px solid white">
            <table style="width:100%; margin-top: 0%;">
                <tr style="width:100%" >
                    <td style="width:100%; padding-left:20px"><img src="{{ $img }}" style="width:200px"/></td>
                    <td style="width:85%"  align="right"  valign="bottom"><h1><span style="font-style:italic; color:#b6b4b4; font-size:16px">Workout Plans Usage Report : {{date('Y-m-d')}}</span></h1></td>
                </tr>
            </table>
            <hr />

            <table style="width:100%"><!-- 3 -->
                <tr style="width:600px">
                    {{-- <td style="background-color:#A6A6A6;width:100%; color:#FFF; padding-left:15px; padding-bottom:7px; padding-top:7px; font-weight:bold">@if($date['from'] != '') Appointments &nbsp;  From {{' : '.$date['from']}} &nbsp; To {{ ' : '.$date['to']}} @else All Appointments @endif</td> --}}
                </tr>
            </table>
        </header>

        <div  class="center content" style="margin-top:3%;  border: 1px solid white">
            <table width="100%" id="diet_plan_table">

                <thead>
                    <tr>
                        <th scope="col">BMI Category</th>
                        <td style="text-align: center; color: green">Normal weight</td>
                    </tr>
                    <tr>
                        <th scope="col">Workout Plan ID</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Workout Plan Name</th>
                        <th scope="col">Total Users Currnetly in Use</th>
                        <th scope="col">Number of Exerices</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $res)
                    @if($res->workout_bmi_category == 'Normal weight')
                        <tr>

                            <td scope="col">{{$res->workout_plan_id}}</td>
                            <td scope="col" >{{$res->created_at}}</td>
                            <td scope="col">{{$res->workout_plan_name}}</td>
                            @if($res->user_count == null)
                            <td scope="col">0</td>
                            @else
                            <td scope="col">{{$res->user_count}}</td>
                            @endif
                            <td scope="col">{{$res->exercise_count}}</td>


                        </tr>
                   @endif
                    @endforeach

                </tbody>
            </table>
<br>
            <table width="100%" id="diet_plan_table">

                <thead>
                    <tr>
                        <th scope="col">BMI Category</th>
                        <td  style="text-align: center; color: red">Obesity</td>
                    </tr>
                    <tr>
                        <th scope="col">Workout Plan ID</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Workout Plan Name</th>
                        <th scope="col">Total Users Currnetly in Use</th>
                        <th scope="col">Number of Exerices</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $res)
                    @if($res->workout_bmi_category == 'Obesity')
                        <tr>
                            <td scope="col">{{$res->workout_plan_id}}</td>
                            <td scope="col" >{{$res->created_at}}</td>
                            <td scope="col">{{$res->workout_plan_name}}</td>
                            <td scope="col">{{$res->user_count}}</td>
                            <td scope="col">{{$res->exercise_count}}</td>
                        </tr>
                   @endif
                    @endforeach

                </tbody>
            </table>

            <br>
            <table width="100%" id="diet_plan_table">

                <thead>
                    <tr>
                        <th scope="col">BMI Category</th>
                        <td  style="text-align: center; color: red">Underweight</td>
                    </tr>
                    <tr>
                        <th scope="col">Workout Plan ID</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Workout Plan Name</th>
                        <th scope="col">Total Users Currnetly in Use</th>
                        <th scope="col">Number of Exerices</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $res)
                    @if($res->workout_bmi_category == 'Underweight')
                        <tr>
                            <td scope="col">{{$res->workout_plan_id}}</td>
                            <td scope="col" >{{$res->created_at}}</td>
                            <td scope="col">{{$res->workout_plan_name}}</td>
                            <td scope="col">{{$res->user_count}}</td>
                            <td scope="col">{{$res->exercise_count}}</td>
                        </tr>
                   @endif
                    @endforeach

                </tbody>
            </table>

            <br>
            <table width="100%" id="diet_plan_table">

                <thead>
                    <tr>
                        <th scope="col">BMI Category</th>
                        <td  style="text-align: center; color: yellowgreen">Overweight</td>
                    </tr>
                    <tr>
                        <th scope="col">Workout Plan ID</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Workout Plan Name</th>
                        <th scope="col">Total Users Currnetly in Use</th>
                        <th scope="col">Number of Exerices</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $res)
                    @if($res->workout_bmi_category == 'Overweight')
                        <tr>
                            <td scope="col">{{$res->workout_plan_id}}</td>
                            <td scope="col" >{{$res->created_at}}</td>
                            <td scope="col">{{$res->workout_plan_name}}</td>
                            <td scope="col">{{$res->user_count}}</td>
                            <td scope="col">{{$res->exercise_count}}</td>
                        </tr>
                   @endif
                    @endforeach
                </tbody>
            </table>
        </div><br/>

        <footer id="footer2" style=" border: 1px solid white">
            <hr />
                <table style="width:100%; vertical-align: bottom; alignment-adjust:central " ><!-- 2 -->
                    <tr style="width:100%;" >
                        <td style="width:100%; text-align:left">
                            <span style="color: #939393">
                                <p>Flex Fitness Ltd<br>Unit C1 and C2 Brearley Place,<br>Baird Road,<br>Quedgeley<br>Gloucester, GL2 2GB</p>
                            </span>
                        </td>
                        <td style="width:100%; text-align:right">
                            <span style="color: #939393">
                                <p>Fax : 03300167689<br>Support Line : 03300167680</p>
                                <p>Web : http://www.flexfitness.com</p>
                            </span>
                        </td>
                    </tr>
                </table>
                <div  align="center"><span style="color: #939393" class="pagenum"></span></div>
        </footer>

    </body>
</html>


