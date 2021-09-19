<?php
namespace App\Services;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class DashboardService
{
    public function getAppointmentCount(){

        $res = Appointment::select('appointment_id')
        ->where('uid',Auth::user()->uid)
        ->whereMonth('appointment_date',Carbon::now()->month -1)
        ->whereYear('appointment_date',Carbon::now()->year)
        ->orderBy('appointment_id','DESC')
        ->get();

        return $res->count();
    }

    public function getCurrentBMI(){
        $res = User::where('uid',Auth::user()->uid)->first();

        $height = $res->height;
        $weight = $res->weight;

        $bmi = number_format((float)$weight/($height*$height), 2, '.', '');

        if($bmi < 18.50){
            $bmi_type = 'Underweight';
            $diet_plan = '1';
        }else if($bmi >= 18.50 && $bmi  < 24.90){
            $bmi_type = 'Normal weight';
            $diet_plan = '2';
        }else if($bmi  >= 24.90 && $bmi  < 30.00){
            $bmi_type = 'Overweight';
            $diet_plan = '3';
        }else{
            $bmi_type = 'Obesity';
            $diet_plan = '4';
        }

        $data['bmi'] = $bmi;
        $data['bmi_type'] = $bmi_type;
        $data['diet_plan'] = $diet_plan;

        return $data;

    }

    public function checkPaymentStatus(){
        $user = User::where('uid', Auth::user()->uid)->first();
        $res = Payment::where('uid',$user->uid)
        ->whereYear('payment_date',Carbon::now()->year)
        ->whereMonth('payment_date',Carbon::now()->month)
        ->get();

        if($res->count() > 0){
            return 1;
        }else{
            return 0;
        }

    }
}

?>
