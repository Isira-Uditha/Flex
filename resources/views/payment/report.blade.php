@php
    use Carbon\Carbon;
    $img = public_path('images/bg_img.png');
    $invoice_date = Carbon::createFromFormat('Y-m-d', $data['payment']->payment_date)->format('m/d/Y');
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Summary Report</title>
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

    </style>
</head>
    <body>
        <header style=" border: 1px solid white">
            <table style="width:100%; margin-top: 0%;">
                <tr style="width:100%" >
                    <td style="width:100%; padding-left:20px"><img src="{{ $img }}" style="width:200px"/></td>
                    <td style="width:70%"  align="right"  valign="bottom"><h1><span style="font-style:italic; color:#b6b4b4; font-size:16px">Invoice On The Due Date : {{$invoice_date}}</span></h1></td>
                </tr>
            </table>
            <hr />

            <table style="width:100%"><!-- 3 -->
                <tr style="width:600px">
                    <td style="background-color:#A6A6A6;width:100%; color:#FFF; padding-left:15px; padding-bottom:7px; padding-top:7px; font-weight:bold">Payment Summary - Invoice No {{$data['payment']->payment_id}}</td>
                </tr>
            </table>
        </header>

        <div  class="center content" style="margin-top:3%;  border: 1px solid white">
            <table   class="center"  style="width: 70%; margin-top:20px;">
                <tbody class="cl3">
                    <tr>
                        <td style="font-size:15px;">&nbsp;Invoice No</td>
                        <td style="text-align: right; font-size:15px;">{{$data['payment']->payment_id}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:15px;">&nbsp;User Name</td>
                        <td style="text-align: right; font-size:15px;">{{Str::title($data['user']->first_name .' '. $data['user']->last_name)}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:15px;">&nbsp;User Email</td>
                        <td style="text-align: right; font-size:15px;">{{$data['user']->email}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:15px;">&nbsp;Date</td>
                        <td style="text-align: right; font-size:15px;">{{$invoice_date}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:15px;">&nbsp;Package</td>
                        <td style="text-align: right; font-size:15px;">{{$data['package']->package_name}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size:15px;">&nbsp;Package Price</td>
                        <td style="text-align: right; font-size:15px;">{{$data['package']->package_price}}&nbsp;</td>
                    </tr>
                    <tr>
                        <td><h3 style="font-size:20px;">&nbsp;Total</h3></td>
                        <td style="text-align: right"><h3 style="font-size:20px;">{{$data['package']->package_price}}&nbsp;</h3></td>
                    </tr>
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


