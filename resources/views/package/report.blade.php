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
    <title>Packages Report</title>
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
        #package_table th, #package_table tr td  {
            border: 1px groove black;
            padding-top: 4px;
            padding-bottom: 4px;
            text-align: center;
        }
        #package_table tr:nth-child(even){background-color: #63a1b94d;}
    </style>
</head>
    <body>
        <header style=" border: 1px solid white">
            <table style="width:100%; margin-top: 0%;">
                <tr style="width:100%" >
                    <td style="width:100%; padding-left:20px"><img src="{{ $img }}" style="width:200px"/></td>
                    <td style="width:70%"  align="right"  valign="bottom"><h1><span style="font-style:italic; color:#b6b4b4; font-size:16px">Package Report : {{date('Y-m-d')}}</span></h1></td>
                </tr>
            </table>
            <hr />

            <table style="width:100%"><!-- 3 -->
                <tr style="width:600px">
                    <td style="background-color:#A6A6A6;width:100%; color:#FFF; padding-left:15px; padding-bottom:7px; padding-top:7px; font-weight:bold">@if($date['from'] != '') Package Enrolment &nbsp;  From {{' : '.$date['from']}} &nbsp; To {{ ' : '.$date['to']}} @else All Package Enrolments @endif</td>
                </tr>
            </table>
        </header>

        <div  class="center content" style="margin-top:3%;  border: 1px solid white">
            <table width="100%" id="package_table">
                <thead>
                    <tr>
                        <th scope="col">Package ID</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Package Duration</th>
                        <th scope="col">Package Price</th>
                        <th scope="col">Members Enrolled</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr>
                        <td scope="col">{{$row->package_id}}</td>
                        <td scope="col">{{$row->package_name}}</td>
                        <td scope="col">{{$row->package_duration}}</td>
                        <td scope="col">{{$row->package_price}}</td>
                        <td scope="col">{{$row->count}}</td>
                    </tr>
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
