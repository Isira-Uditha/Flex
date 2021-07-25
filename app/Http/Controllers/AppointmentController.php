<?php

namespace App\Http\Controllers;

use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        $app_service = new AppointmentService();

        if ($request->ajax()) {
            $appointments= $app_service->getAppointments($request->all());
            return datatables()->of($appointments)
            ->addColumn('appointment_id', function ($row) {
                return $row->appointment_id;
            })
            ->addColumn('appointment_date', function ($row) {
                return $row->appointment_date;
            })
            ->addColumn('time_slot', function ($row) {
                return $row->time_slot;
            })
            ->addColumn('workout_plan_name', function ($row) {
                return $row->workout_plan_name;
            })
            ->addColumn('bmi', function ($row) {
                return $row->bmi;
            })
            ->addColumn('bmi_type', function ($row) {
                return $row->bmi_type;
            })
            ->addColumn('current_height', function ($row) {
                return $row->current_height;
            })
            ->addColumn('current_weight', function ($row) {
                return $row->current_weight;
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . url('sample/' . $row->id) . '" class="' . "delete-giveaway" . '"><i class="fas fa-trash-alt text-danger font-16"></i></a>';
            })
            ->rawColumns(['action'])

            ->make(true);
        }

        $data['workouts'] = $app_service->getAllWorkouts();
        return view('appointment.index',compact('data'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
