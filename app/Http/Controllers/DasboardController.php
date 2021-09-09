<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dashboard_service = new DashboardService();
        $data['app_count'] = $dashboard_service->getAppointmentCount();
        $data['bmi'] = $dashboard_service->getCurrentBMI();
        $data['payment'] = $dashboard_service->checkPaymentStatus();
        return view('dashboard.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBMIValues(Request $request){

        $data['bmi'] = $this->getSelectedBMIType('bmi');
        $data['appointment_date'] = $this->getSelectedBMIType('appointment_date');

        return response()->json(['data' => $data], 200);
    }

    public function getSelectedBMIType($data){

        $user = User::where('uid', 1)->first();

        $res = Appointment::select($data)
        ->where('uid',1)
        ->get();

        return $res;
    }
}
