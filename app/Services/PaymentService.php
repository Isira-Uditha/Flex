<?php
namespace App\Services;

use App\Models\Appointment;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Support\Carbon;
use DB;
use Auth;

class PaymentService
{
    public function getPayments($data){

        $res = Payment::select('payment.*','p.package_id','p.package_name','p.package_price')
        ->join('package as p','p.package_id','payment.package_id')
        ->join('user as u','u.uid','payment.uid')
        ->when(isset($data['payment_id']) && $data['payment_id'] != '', function($q) use($data) {
            return $q->where('payment.payment_id', $data['payment_id']);
        })
        ->when(isset($data['payment_year']) && $data['payment_year'] != '', function($q) use($data) {
            return $q->whereYear('payment.payment_date', $data['payment_year']);
        })
        ->when(isset($data['payment_month']) && $data['payment_month'] != '', function($q) use($data) {
            return $q->whereMonth('payment.payment_date', $data['payment_month']);
        })
        ->where('payment.uid',Auth::user()->uid)
        ->orderBy('payment_id','DESC')
        ->get();

        return $res;
    }

    public function getAllPackages(){
        $res = Package::get();
        return $res;
    }

    public function getSelectedPackages($uid){
        $res = User::select('package_id')
        ->where('uid',$uid)
        ->first();

        return $res;
    }
}
?>
