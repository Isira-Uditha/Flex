<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\WorkoutPlan;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\AssignOp\Concat;

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
            ->addColumn('appointment_no', function ($row) {
                return $row->appointment_no;
            })
            ->addColumn('appointment_date', function ($row) {
                $app_date = Carbon::createFromFormat('Y-m-d',$row->appointment_date)->format('m/d/Y');
                return $app_date;
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
                $bmi_type = '';

                if($row->bmi_type == 'Underweight'){
                    $bmi_type = '<span class="tag tag-red">Underweight</span>';
                }else if($row->bmi_type == 'Normal weight'){
                    $bmi_type = '<span class="tag tag-green">Normal weight</span>';
                }else if($row->bmi_type == 'Overweight'){
                    $bmi_type = '<span class="tag tag-yellow">Overweight</span>';
                }else{
                    $bmi_type = '<span class="tag tag-red tx-12">Obesity</span>';
                }

                return $bmi_type;
            })
            ->addColumn('current_height', function ($row) {
                return $row->current_height;
            })
            ->addColumn('current_weight', function ($row) {
                return $row->current_weight;
            })
            ->addColumn('action', function ($row) {
                // href="' . route('appointment_view',['action' => 'Delete','id' => $row->appointment_id]) . '"
                $delete = '<a data-placement="top" data-toggle="tooltip-primary" title="Delete" data-appid = "'.$row->appointment_id.'" ><i class="fas fa-trash-alt text-danger font-16 delete"></i></a> ';
                $edit = ' <a href="' . route('appointment_view',['action' => 'Edit','id' => $row->appointment_id]) . '" data-toggle="tooltip-primary" title="Edit"><i class="fas fa-edit text-warning font-16" data-placement="top"></i></a>';
                return $edit.' '.$delete;
            })
            ->rawColumns(['action','bmi_type'])

            ->make(true);
        }

        $data['workouts'] = $app_service->getAllWorkouts();
        return view('appointment.index',compact('data'));
    }

    public function view(Request $request){
        $action = $request->action;
        $id = $request->id;
        $app_service = new AppointmentService();

        switch($action) {
            case 'Add':

                $data['workouts'] = $app_service->getAllWorkouts();
                $data['userName'] = User::select(DB::raw("CONCAT(first_name,' ',last_name) As userName"))->where('uid', 1)->first();
                $data['userID'] = User::select('uid')->where('uid', 1)->first();
                $data['action'] = 'Add';
                return view('appointment.create',compact('data'));
                 break;
            case 'Edit':

                $data['workouts'] = $app_service->getAllWorkouts();
                $data['userName'] = User::select(DB::raw("CONCAT(first_name,' ',last_name) As userName"))->where('uid', 1)->first();
                $data['userID'] = User::select('uid')->where('uid', 1)->first();
                $data['result'] = Appointment::where('appointment_id',$id)->first();
                $data['action'] = 'Edit';
                $data['id'] = $id;
                return view('appointment.create',compact('data'));
                break;
            default:
        }
    }

    public function create(Request $request)
    {
        $action = $request->action;
        $id = $request->id;
        $data = $request->all();

        if($action == 'Add' || $action == 'Edit'){
            $rules = [
                'uid' => 'required',
                'userName' => 'required',
                'appointment_date' => 'required',
                'current_height' => 'required|between:0,999.99',
                'current_weight' => 'required|between:0,999.99',
                'workout_plan_id' => 'required',
                'time_slot' => 'required',
                'bmi' => 'required',
            ];
        }else{
            $rules = [];
        }

        $validatedData = Validator::make(
            $request->all(),
            $rules,
            [
                'uid.required' => 'This field is required',
                'userName.required' => 'This field is required',
                'appointment_date.required' => 'This field is required',
                'current_height.required' => 'This field is required',
                'current_weight.required' => 'This field is required',
                'workout_plan_id.required' => 'This field is required',
                'time_slot.required' => 'This field is required',
                'bmi.required' => 'This field is required',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withInput()->withErrors($validatedData->errors())
                ->with('error_message', 'please check as we’re missing some information.');
        } else {
            $app_service = new AppointmentService();
            switch($action) {
                case 'Add':
                    $res = $this->store($data);
                    if($res){
                        if($this->updateUserDetails($data)){
                            return redirect(route('appointment_index'))->with('success_message', 'Record created succefully ');
                        }else{
                            return redirect()->back()->with('error_message', 'User details are not updated.');
                        }
                    }else{
                        return redirect()->back()->withInput()->withErrors($validatedData->errors())
                        ->with('error_message', 'please check as we’re missing some information.');
                    }
                    // return view('appointment.create',compact('data'));
                    break;
                case 'Edit':
                    $res = $this->update($data,$id);
                    if($res){
                        if($this->updateUserDetails($data)){
                            return redirect()->back()->with('success_message', 'Record updated succefully ');
                        }else{
                            return redirect()->back()->with('error_message', 'User details are not updated.');
                        }
                    }else{
                        return redirect()->back()->withInput()->withErrors($validatedData->errors())
                        ->with('error_message', 'please check as we’re missing some information.');
                    }
                    break;
                    case 'Delete':
                        $res = $this->destroy($id);
                        if($res){
                            return response()->json(['success' => 1, 'success_message' => 'Record deleted succefully'], 200);
                        }else{
                            return response()->json(['success' => 0, 'success_message' => 'Request unsuccefull'], 200);
                        }
                default:
            }
        }

    }


    public function store($data)
    {
        $appointment = new Appointment();
        $bmi = $this->getBMIAndType($data['current_height'],$data['current_weight']);
        $appointment->uid = $data['uid'];
        $appointment->appointment_no = $data['appointment_no'];
        $appointment->appointment_date = Carbon::createFromFormat('m/d/Y',$data['appointment_date'])->format('Y-m-d');
        $appointment->current_height = $data['current_height'];
        $appointment->current_weight = $data['current_weight'];
        $appointment->workout_plan_id = $data['workout_plan_id'];
        $appointment->diet_plan_id = $bmi['diet_plan'];
        $appointment->time_slot = $data['time_slot'];
        $appointment->bmi = $bmi['bmi'];
        $appointment->bmi_type = $bmi['bmi_type'];

        return $appointment->save();

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update($data,$id)
    {
        $appointment = Appointment::where('appointment_id',$id)->first();

        $bmi = $this->getBMIAndType($data['current_height'],$data['current_weight']);

        $appointment->appointment_no = $data['appointment_no'];
        $appointment->appointment_date = Carbon::createFromFormat('m/d/Y',$data['appointment_date'])->format('Y-m-d');
        $appointment->current_height = $data['current_height'];
        $appointment->current_weight = $data['current_weight'];
        $appointment->workout_plan_id = $data['workout_plan_id'];
        $appointment->diet_plan_id = $bmi['diet_plan'];
        $appointment->time_slot = $data['time_slot'];
        $appointment->bmi = $bmi['bmi'];
        $appointment->bmi_type = $bmi['bmi_type'];

        return $appointment->save();
    }

    public function destroy($id)
    {
        $res = Appointment::where('appointment_id',$id)->delete();
        return $res;
    }

    public function getBMIAndType($height,$weight)
    {
        $bmi =   number_format((float)$weight/($height*$height), 2, '.', '');
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

    public function getSugestedSchedules(Request $request){
        $bmi = $request->bmi;
        if($bmi < 18.50){
            $bmi_type = 'Underweight';
        }else if($bmi >= 18.50 && $bmi  < 24.90){
            $bmi_type = 'Normal weight';
        }else if($bmi  >= 24.90 && $bmi  < 30.00){
            $bmi_type = 'Overweight';
        }else{
            $bmi_type = 'Obesity';
        }

        $res = WorkoutPlan::select('*')->where('workout_bmi_category',$bmi_type)->get();

        return response()->json(['success' => 1, 'data' => $res], 200);
    }

    public function checkAppointmentStatus(Request $request){
        $res = Appointment::where('appointment_date',Carbon::createFromFormat('m/d/Y',$request->appointment_date)->format('Y-m-d'))
        ->where('time_slot',$request->time_slot)
        ->get();

        $count = $res->count();
        if($count < 8){
            $availablity = true;
            $number = $count + 1;
        }else{
            $availablity = false;
            $number = '';
        }
        return response()->json(['data' => $res,'availablity' => $availablity,'number' => $number],200);
    }

    public function updateUserDetails($data){
        $user = User::where('uid', 1)->first();

        $user->height = $data['current_height'];
        $user->weight = $data['current_weight'];

        return $user->save();
    }

}
